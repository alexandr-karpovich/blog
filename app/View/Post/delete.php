<div class="col-md-10">
    <div class="panel">
        <div class="panel-body">

            <h2><?php echo $title?> </h2>
            <hr>

            <?php if( isset($post) ): ?>

                <h3>Please confirm delete action for "<span><?php echo $post->getTitle() ?></span>"</h3>

                <a href="javascript:window.history.back();">
                    <button type="button" class="btn btn-default">Back</button>
                </a>
                <a class="" href="/post/delete?id=<?php echo $post->getId()?>&confirm">
                    <button type="button" class="btn btn-default btn-danger">Confirm delete</button>
                </a>

            <?php endif; ?>

        </div>
    </div>
</div>


