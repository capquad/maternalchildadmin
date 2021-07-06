<?php

use Functions\Resolver;

require './init.php';

Resolver::require('views/snippets/header');
?>
<!-- #main: main page content -->
<div id="main">
  <div class="container">
    <h1 class="mt-3"><small class="text-muted">Hi,</small> {User}</h1>

    <div class="mt-4">
      <div class="row">
        <div class="col-sm-6">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-user"></i> Patients
            </div>
            <div class="card-body">
              <span class="fa-3x">
                36
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 mt-4 mt-sm-0">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-male"></i> Staff
            </div>
            <div class="card-body">
              <span class="fa-3x">
                28
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 mt-4 mt-sm-0">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-bed"></i> Wards
            </div>
            <div class="card-body">
              <span class="fa-3x">
                12
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6 mt-4 mt-sm-0">
          <div class="card">
            <div class="card-header">
              <i class="fa fa-user-nurse"></i> Departments
            </div>
            <div class="card-body">
              <span class="fa-3x">
                7
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
Resolver::require('views/snippets/footer');
