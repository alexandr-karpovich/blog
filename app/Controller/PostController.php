<?php


namespace Controller;

use Lib\View;
use Model\Post;

class PostController
{
    /**
     * @return bool
     */
    public function listAction()
    {
        // TODO add pagination
        $posts = Post::getAll();

        return View::renderTemplate('Post/list', [
            'posts' => $posts,
            'title' => 'Latest posts'
        ]);
    }

    /**
     * View post page
     *
     * @return bool
     * @throws \Exception
     */
    public function viewAction()
    {
        if( !($id = $_REQUEST['id']) )
            throw new \Exception('Id param is required');

        return View::renderTemplate('Post/view', [
            'post' => Post::get($id),
            'title' => 'Post page'
        ]);
    }

    /**
     * Delete page (with confirm)
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteAction()
    {
        if( !(isset($_REQUEST['id'])) )
            throw new \Exception('Id param is required');

        $post = Post::get($_REQUEST['id']);

        if( isset($_REQUEST['confirm']) )
        {
            $post->delete();
            header("Location: /post/list");
        }

        return View::renderTemplate('Post/delete', [
            'post' => $post,
            'title' => 'Delete post'
        ]);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function editAction()
    {
        /**
         * @var Post $post
         */
        $post = ( !empty($_REQUEST['id']) ) ? Post::get($_REQUEST['id']) : new Post();

        $params = [];

        // do it if we submit form
        if ( isset($_REQUEST['submit']) )
        {
            $errors = [];

            ( !empty($_REQUEST['title']) )       ? $post->setTitle(htmlspecialchars(strip_tags($_REQUEST['title'])))               : $errors['title']       = 'Required';
            ( !empty($_REQUEST['description']) ) ? $post->setDescription(htmlspecialchars(strip_tags($_REQUEST['description'])))   : $errors['description'] = 'Required';
            ( !empty($_REQUEST['content']) )     ? $post->setContent(htmlspecialchars(strip_tags($_REQUEST['content'])))           : $errors['content']     = 'Required';

            // errors
            $params['status'] = false;
            if ( count($errors) )
            {
                $params['errors'] = $errors;

            // save object
            } else {

                if ( $id = $post->save() )
                {
                    $post = Post::get($id);
                    $params['status'] = true;
                }
            }
        }

        $params = array_merge($params, [
            'post' => $post,
            'title' => ($post->getId()) ? 'Edit post' : 'Create post',
        ]);

        return View::renderTemplate('Post/edit', $params);
    }
}