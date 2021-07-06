<?php

use Functions\Resolver;

require './init.php';

$stylesheets = ['table.css'];
Resolver::require('views/snippets/header');
?>

<div id="main">
  <div class="container py-4">
    <h2>Patients</h2>
  </div>

  <div class="table-wrapper container">
    <table id="data-table" class="data-table">
      <thead>
        <tr>
          <th></th>
          <th>ID</th>
          <th>Name</th>
          <th>Category</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </div>
</div>

<?php
$scripts = ['table.js'];
Resolver::require('views/snippets/footer');
