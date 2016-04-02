<div class="col-md-10">
    <div class="panel">
        <div class="panel-body">

            <h2><?php echo $title?> </h2>

            <hr>

            <?php if( isset($post) ): ?>

                <?php /** @var \Model\Post $post */?>


                <a href="javascript:window.history.back();">
                    <button type="button" class="btn btn-default">Back</button>
                </a>
                <a href="/post/edit">
                    <button type="button" class="btn btn-default text-success">
                        <span class="text-success">Create new</span>
                    </button>
                </a>
                <a href="/post/edit?id=<?php echo $post->getId() ?>">
                    <button type="button" class="btn btn-default ">
                        <span class="text-primary">Edit</span>
                    </button>
                </a>
                <a href="/post/delete?id=<?php echo $post->getId() ?>">
                    <button type="button" class="btn btn-default ">
                        <span class="text-danger">Delete</span>
                    </button>
                </a>

                <div class="row">
                    <div class="col-md-12 col-sm-8">
                        <h3><?php echo $post->getTitle() ?></h3>
                        <div class="row">
                            <div class="col-xs-12">
                                <p>
                                    <?php echo $post->getContent() ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
</div>

