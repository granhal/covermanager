import { Component, OnInit, Pipe, PipeTransform } from '@angular/core';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { ApiService } from '../api.service';

@Pipe({
  name: 'filter'
})

export class FilterPipe implements PipeTransform {
  transform(items: any[], searchText: string): any[] {
    if(!items) return [];
    if(!searchText) return items;
    searchText = searchText.toLowerCase();
    return items.filter(it => {
      return it.name.toLowerCase().includes(searchText);
    });
  }
}

@Component({
  selector: 'app-student',
  templateUrl: './student.component.html',
  styleUrls: ['./student.component.scss'],
  providers: [FilterPipe]
})
export class StudentComponent implements OnInit {

  students: any;
  student: any;
  expedient: any;
  subjects: any;
  searchText;

  constructor(private modalService: NgbModal, private apiService: ApiService) { }

  ngOnInit(): void {
    this.getAll();
  }

  getAll() {
    this.apiService.getEntities('student').subscribe(res => {
      this.students = res['studentInfo'];
    });
  }

  open(content, data, origin) {
    this.student = data;
    switch (origin) {
      case 'expedient':
        this.apiService.getEntityById('expedient', data).subscribe(expedient => {
          this.expedient = expedient['expedientInfo'];
          this.apiService.getEntityById('subject', this.expedient.id_expedient).subscribe(subject => {
            this.subjects = subject['subjectInfo'];
          });
        });
        break;
      };
    this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
      switch (origin) {
        case 'add':
          this.apiService.createEntity('student', result).subscribe(res => {
            const telephones = result['telephones'].split(',');
            telephones.forEach(element => {
              this.apiService.createEntity('telephone', { number: element, id_student: res['id'] }).subscribe(res => {});
            });
            this.getAll();
          });
          break;
        case 'delete':
          this.apiService.deleteEntity('student', data['id_student']).subscribe(res => { this.getAll(); });
          break;
        case 'update':
          if(data.number){
            const numbers = data.numbers.split(',');
            numbers.forEach(element => {
              this.apiService.deleteEntity('telephone', element).subscribe(res => {});
            });
          }
          result.id_student = data.id_student;
          this.apiService.updateEntity('student', result).subscribe(res => {
            const telephones = result['telephones'].split(',');
            telephones.forEach(element => {
              this.apiService.createEntity('telephone', { number: element, id_student: data['id_student'] }).subscribe(res => {});
            });
            this.getAll();
          });
      }
    }, (reason) => {
      console.log(`Dismissed ${this.getDismissReason(reason)}`);
    });
  }

  private getDismissReason(reason: any): string {
    if (reason === ModalDismissReasons.ESC) {
      return 'by pressing ESC';
    } else if (reason === ModalDismissReasons.BACKDROP_CLICK) {
      return 'by clicking on a backdrop';
    } else {
      return  `with: ${reason}`;
    }
  }
  isDecimalToFixed(num){
    return Number(num).toFixed(2);
  }
}
