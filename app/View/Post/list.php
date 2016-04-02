<div class="col-md-10">
    <div class="panel">
        <div class="panel-body">

            <h2><?php echo $title?>
                <button type="button" class="btn btn-default pull-right "><a class="text-success" href="/post/edit">Create new post</a></button>
            </h2>

            <?php if( isset($posts) ): ?>
                <?php foreach($posts as $post): ?>

                    <?php /** @var \Model\Post $post */?>

                    <hr>
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <h3><a class="text-primary" href="/post/view?id=<?php echo $post->getId()?>"><?php echo($post->getTitle()) ?></a></h3>
                            <div class="row">
                                <div class="col-xs-12">
                                    <p>
                                        <?php echo($post->getDescription()) ?>
                                    </p>
                                    <a href="/post/view?id=<?php echo $post->getId()?>">
                                        <button class="btn btn-default"><span class="text-primary">Read More</span></button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</div>


