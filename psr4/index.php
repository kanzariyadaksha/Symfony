<?php

 use Codecourse\Repositories\UserRepository;
 use Codecourse\Fillters\AuthFilter;
 use Stream\Fillters_stream\AuthFilter_;

 require_once 'app/start.php';

 $Authr = new AuthFilter();
 $UserRepo =new UserRepository();
 $AuthFilter_  =new AuthFilter_();

 echo  $Authr->test();
 echo  $UserRepo->tes124545();
 echo  $AuthFilter_->test47();
