import { Component, OnInit } from '@angular/core';
import { NgbModal, ModalDismissReasons } from '@ng-bootstrap/ng-bootstrap';
import { ApiService } from '../api.service';
@Component({
  selector: 'app-expedient',
  templateUrl: './expedient.component.html',
  styleUrls: ['./expedient.component.scss']
})
export class ExpedientComponent implements OnInit {

  expedients: any;
  expedient: any;
  subjects: any;
  subject: any;

  constructor(private modalService: NgbModal, private apiService: ApiService) { }

  ngOnInit(): void {
    this.getAll();
  }
  getAll() {
    this.apiService.getEntities('expedient').subscribe(res => {
      this.expedients = res['expedientInfo'];
    });
    this.apiService.getEntities('subject').subscribe(res => {
      this.subjects = res['subjectInfo'];
    });
  }
  open(content, data, origin) {
    this.expedient = data;

    this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
      switch (origin) {
        case 'add':
          this.apiService.createEntity('expedient', result).subscribe(res => {
            this.getAll();
          });
          break;
        case 'delete':
          this.apiService.deleteEntity('expedient', data['id_expedient']).subscribe(res => { this.getAll(); });
          break;
        case 'update':
          result.id_expedient = data.id_expedient;
          this.apiService.updateEntity('expedient', result).subscribe(res => {
            this.getAll();
          });
      }
    }, (reason) => {
      console.log(`Dismissed ${this.getDismissReason(reason)}`);
    });
  }
  openSubject(content, data, origin) {
    this.subject = data;

    this.modalService.open(content, {ariaLabelledBy: 'modal-basic-title'}).result.then((result) => {
      switch (origin) {
        case 'add':
          this.apiService.createEntity('subject', result).subscribe(res => {
            this.getAll();
          });
          break;
        case 'delete':
          this.apiService.deleteEntity('subject', data['id_subject']).subscribe(res => { this.getAll(); });
          break;
        case 'update':
          result.id_subject = data.id_subject;
          this.apiService.updateEntity('subject', result).subscribe(res => {
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
}
