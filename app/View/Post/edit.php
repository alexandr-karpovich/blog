<div class="col-md-10">
    <div class="panel">
        <div class="panel-body">

            <h2><?php echo $title?> </h2>

            <?php if( isset($status) ):?>
                <?php if( $status == true ):?>
                    <div class="text-success save-status">Saved</div>
                <?php else: ?>
                    <div class="text-danger save-status">Error</div>
                <?php endif ?>
            <?php endif ?>

            <hr>

            <?php /** @var \Model\Post $post */?>

            <a href="javascript:window.history.back();">
                <button type="button" class="btn btn-default">Back</button>
            </a>
            <?php if( isset($post) && $post->getId() ):?>
                <a href="/post/view?id=<?php echo $post->getId()?>">
                    <button type="button" class="btn btn-default">
                        <span class="text-primary">View</span>
                    </button></a>
                <a href="/post/edit">
                    <button type="button" class="btn btn-default">
                        <span class="text-success">Create new</span>
                    </button>
                </a>
                <a href="/post/delete?id=<?php echo $post->getId() ?>">
                    <button type="button" class="btn btn-default">
                        <span class="text-danger">Delete</span>
                    </button>
                </a>
            <?php endif ?>
            <br>
            <br>

            <form action="/post/edit?submit" method="post" class="form">
                <fieldset class="form-group <?php if( isset($errors) && isset($errors['title']) ): ?>has-error<?php endif?>">
                    <label for="title">Title<sup>*</sup></label>
                    <?php if( isset($errors) && isset($errors['title']) ): ?><div class="text-danger"><?php echo $errors['title'] ?></div><?php endif?>
                    <input type="text" class="form-control" id="title" name="title" required="required" <?php if( isset($post) ):?> value="<?php echo $post->getTitle() ?>" <?php endif ?> >
                </fieldset>

                <fieldset class="form-group <?php if( isset($errors) && isset($errors['description']) ): ?>has-error<?php endif?>">
                    <label for="description">Description<sup>*</sup></label>
                    <?php if( isset($errors) && isset($errors['description']) ): ?><div class="text-danger"><?php echo $errors['description'] ?></div><?php endif?>
                    <textarea class="form-control" id="description"  name="description"  rows="7" required="required"><?php if( isset($post) ) echo $post->getDescription() ?></textarea>
                </fieldset>

                <fieldset class="form-group <?php if( isset($errors) && isset($errors['content']) ): ?>has-error<?php endif?>">
                    <label for="content">Content<sup>*</sup></label>
                    <?php if( isset($errors) && isset($errors['content']) ): ?><div class="text-danger"><?php echo $errors['content'] ?></div><?php endif?>
                    <textarea class="form-control" id="content"  name="content"  rows="5" required="required"><?php if( isset($post) ) echo $post->getContent() ?></textarea>
                </fieldset>

                <?php if( isset($post) && $post->getId() ):?>
                    <input type="hidden" name="id" value="<?php echo $post->getId() ?>">
                <?php endif ?>

                <button type="submit" class="btn btn-primary pull-right">Save</button>
            </form>

        </div>
    </div>
</div>


