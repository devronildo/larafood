<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface{

     public function getProductsByTenantId(int $idTenant, array $categories);
     public function getProductByFlag(string $flag);



}
