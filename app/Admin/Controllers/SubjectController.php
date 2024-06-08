<?php

namespace App\Admin\Controllers;

use App\Models\User;
use App\Models\Subject;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form; 
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SubjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Subject'; 

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Subject());

        $grid->column('id', __('Id'));
        
        $grid->column('name', __('Name'));
    
        $grid->column('image_url', __('Image URL'))->image('', 50, 50);
    
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
        $show = new Show(Subject::findOrFail($id));

        $show->field('id', __('Id'));
      
        $show->field('name', __('Name'));
        $show->field('image_url', __('Image URL'));
    
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }
    protected function form(){
        $form = new Form(new Subject());
        $form->text('name', __('Name'));
  
        $form->image('image_url', __('Image URL'))->uniqueName();
        $form->display('created_at', __('Created at'));
        $form->display('updated_at', __('Updated_at'));


        // $form->select('parent_id', __('Parent Category'))->options((new CourseType())::selectOptions());
        // $form->text('title', __('Title'));
        // $form->textarea('description', __('Description'));
        // $form->number('Order', __('Order'));

        return $form;
    }
}
