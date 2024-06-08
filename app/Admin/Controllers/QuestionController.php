<?php

namespace App\Admin\Controllers;

use App\Models\Lecture;
use App\Models\Question;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class QuestionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Questions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Question());

        $grid->column('id', __('Id'));
        $grid->column('content', __('Content'));
        $grid->column('lecture_id', __('Lecture'))->display(function($id){
            return Lecture::where('id', $id)->value('name');
        });
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Question::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('content', __('Content'));
        $show->field('lecture_id', __('Lecture Id'))->as(function($id) {
            return Lecture::where('id', $id)->value('name');
        });
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        // $show->options('Options', function ($option) {
        //     $option->resource('/admin/options');
        //     $option->id();
        //     $option->content();
        //     $option->is_correct()->bool();
        //     $option->question_id($id);
        //     $option->created_at();
        //     $option->updated_at();
        // });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Question());

        $form->text('content', __('Content'))->required();
        $form->select('lecture_id', __('Lecture'))->options(
            Lecture::pluck('name', 'id')
        )->required();

        // $form->hasMany('options', function (Form\NestedForm $form) {
        //     $form->text('content', __('Option Content'))->required();
        //     $form->switch('is_correct', __('Is Correct'))->default(0);
        // });

        return $form;
    }
}
