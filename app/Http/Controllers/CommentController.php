<?php

namespace App\Http\Controllers;

use App\CommentRepository;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $comment;
    function __construct(CommentRepository $comment)
    {
        $this->comment=$comment;
    }



}
