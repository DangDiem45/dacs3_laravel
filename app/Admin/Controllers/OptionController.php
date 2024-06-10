<?php

namespace App\Admin\Controllers;

use App\Models\Lecture;
use App\Models\Option;
use App\Models\Question;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form; 
use Encore\Admin\Grid;
use Encore\Admin\Show;

class OptionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Options'; 

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Option());

        $grid->column('id', __('Id'));
        $grid->column('content', __('Content'));
        $grid->column('is_correct', __('Is Correct'))->bool();
        $grid->column('question_id', __('Question'))->display(function($id){
            $item = Question::where('id',"=", $id)->value("content");
            return $item;
        });
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
        $show = new Show(Option::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('content', __('Content'));
        $show->field('is_correct', __('Is Correct'))->bool();
        $show->field('question_id', __('Question'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }
    
    protected function form()
    {
        $form = new Form(new Option());

        $form->text('content', __('Content'));
        $form->switch('is_correct', __('Is Correct'))->default(0);
        
        $result = Question::pluck('content','id');
        $form->select('question_id', __('Question'))->options($result);

        return $form;
    }
}
