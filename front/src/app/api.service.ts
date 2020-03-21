import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  apiURL = 'http://localhost:8888/covermanager/api';

  constructor(private httpClient: HttpClient) { }
  public createEntity(entity: string, data: any) {
    const formData = new FormData();
    switch(entity) {
      case 'student':
        formData.append('name', data['name']);
        formData.append('address', data['address']);
        formData.append('email', data['email']);
        break;
      case 'expedient':
        formData.append('number', data['number']);
        formData.append('id_student', data['id_student']);
        break;
      case 'telephone':
        formData.append('number', data['number']);
        formData.append('id_student', data['id_student']);
        break;
      case 'subject':
        formData.append('note', data['note']);
        formData.append('name', data['name']);
        formData.append('id_expedient', data['id_expedient']);
        break;
    }
    return this.httpClient.post(`${this.apiURL}/${entity}/create/`, formData);
  }

  public updateEntity(entity: string, data: any) {
    const formData = new FormData();
    switch(entity) {
      case 'student':
        formData.append('id', data['id_student']);
        formData.append('name', data['name']);
        formData.append('address', data['address']);
        formData.append('email', data['email']);
        break;
      case 'expedient':
        formData.append('id', data['id_expedient']);
        formData.append('number', data['number']);
        formData.append('id_student', data['id_student']);
        break;
      case 'telephone':
        formData.append('id', data['id_telephone']);
        formData.append('number', data['number']);
        formData.append('id_student', data['id_student']);
        break;
      case 'subject':
        formData.append('id', data['id_subject']);
        formData.append('note', data['note']);
        formData.append('name', data['name']);
        formData.append('id_expedient', data['id_expedient']);
        break;
    }

    return this.httpClient.post(`${this.apiURL}/${entity}/update/`, formData);
  }

  public deleteEntity(entity: string, id: number) {
    return this.httpClient.get(`${this.apiURL}/${entity}/delete/${id}`);
  }

  public getEntityById(entity: string, id: number) {
    return this.httpClient.get(`${this.apiURL}/${entity}/read/${id}`);
  }

  public getEntities(entity: string) {
    return this.httpClient.get(`${this.apiURL}/${entity}/read/`);
  }
}
