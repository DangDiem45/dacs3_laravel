<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\Subject;
use App\Models\Lecture;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form; 
use Encore\Admin\Grid;
use Encore\Admin\Show;

class LectureController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Course'; 

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Lecture());

        $grid->column('id', __('Id'));
    
        $grid->column('name', __('Name'));
        $grid->column('subject_id', __('Subject'))->display(function($id){
            $item = Subject::where('id',"=", $id)->value("name");
            return $item;
        });

        $grid->column('duration', __('Duration'));
    
        $grid->column('created_at', __('Created at'));
    
    

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Lecture::findOrFail($id));

        $show->field('id', __('Id'));
      
        $show->field('name', __('Name'));
        $show->field('subject_id', __('Subject Id'));

        $show->field('duration', __('Duration'));

        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }
    protected function form(){
        $form = new Form(new Lecture());
        $form->text('name', __('Name'));
        $result = Subject::pluck('name','id');
        $form->select('subject_id', __('Subject'))->options($result);
        $form->number('duration', __('Duration'));

        return $form;
    }
}
