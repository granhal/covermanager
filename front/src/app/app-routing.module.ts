import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { StudentComponent } from './student/student.component';
import { ExpedientComponent } from './expedient/expedient.component';

const routes: Routes = [
  { path: 'students', component: StudentComponent },
  { path: 'expedients',      component: ExpedientComponent },
  { path: '',
    redirectTo: '/students',
    pathMatch: 'full'
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
