<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Code Challenge</title>
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: sans-serif;
                height: 100vh;
                margin: 50px;
            }

            .full-height {
                height: 100vh;
            }

            .result {
            }
            table, td, th {  
                border: 1px solid #ddd;
                text-align: left;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <div class="full-height">
            <div class="result">
                Your Search Term Was: <b><?php echo e($searchTerm); ?></b>                
            </div>            
            <h3>Album</h3>
            <hr>
            <table>
                <?php $__currentLoopData = $album->albums->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($result->name); ?></td>
                    <td><img src="<?php echo e($result->images[0]->url); ?>" style="width: 80px;height: 80px;"></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <h3>Artist</h3>
            <hr>
            <table>
                <?php $__currentLoopData = $artist->artists->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($result1->name); ?></td>
                    <td>
                        <?php if(isset($result1->images[0]->url) && $result1->images[0]->url!=''): ?>
                        <img src="<?php echo e($result1->images[0]->url); ?>" style="width: 80px;height: 80px;">
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
            <h3>Tracks</h3>
            <hr>
            <table>
                <?php $__currentLoopData = $track->tracks->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($result1->name); ?></td>  
                    <td>
                        <?php if(isset($result1->album->images[0]->url) && $result1->album->images[0]->url!=''): ?>
                        <img src="<?php echo e($result1->album->images[0]->url); ?>" style="width: 80px;height: 80px;">
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\challenge\resources\views/search.blade.php ENDPATH**/ ?>