<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Information</title>
    <link rel="stylesheet" href="styles.css" />
    <style>
        /* Resetting default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #333;
        }

        /* Category Section */
        .level {
            font-size: 3rem;
            margin-bottom: 1rem;
            text-align: center;
            color: #fff;
            background: linear-gradient(to right, #ffcc00, #ff9900);
            padding: 1rem;
            font-weight: 700;
            border-radius: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .level:hover {
            transform: translateY(-5px);
        }

        /* Product Image */
        .category-image {
            margin-bottom: 1rem;
            display: flex;
            justify-content: center;
            width: 100%;
        }

        .category-image img {
            width: 300px;
            height: 300px;
            border-radius: 15px;
            object-fit: cover;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .category-image img:hover {
            transform: scale(1.05);
        }

        /* Product Information Card */
        .cat-information {
            background: #fff;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 90%;
            max-width: 600px;
            transition: transform 0.3s ease-in-out;
        }

        .cat-information:hover {
            transform: translateY(-5px);
        }

        /* Title and Description */
        .cat-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .cat-description {
            font-size: 1.1rem;
            color: #777;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        /* Barcode and ID */
        .cat-barcode,
        .cat-id {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 1rem;
        }

        .cat-barcode {
            font-weight: 600;
            letter-spacing: 1px;
        }

        .cat-id {
            font-style: italic;
            color: #ff9900;
        }
    </style>
</head>

<body>

    <!-- Category of Product Section -->
    <div class="level">
        <p>Category Of <?php echo e($data->category_name); ?></p>
    </div>

    <!-- Product Image -->
    <div class="category-image">
        <!-- Category Image -->
        <?php if($data->category_image): ?>
            <img src="<?php echo e(asset('baackend_images/' . $data->category_image)); ?>" alt="<?php echo e($data->category_name); ?> Image"
                class="category-image">
        <?php else: ?>
            <p>No image available.</p>
        <?php endif; ?>
    </div>

    <!-- Product Information Section -->
    <div class="cat-information">
        <!-- Barcode Image Placeholder -->
        <!-- Barcode Image Placeholder -->
        <?php if($data->category_barcode_image): ?>
            <img src="<?php echo e(asset('baackend_images/' . $data->category_barcode_image)); ?>"
                alt="Barcode for <?php echo e($data->category_name); ?>" class="barcode-image">
        <?php else: ?>
            <p>No barcode available.</p>
        <?php endif; ?>


        <!-- Product Title -->
        <h1 class="cat-title"><?php echo e($data->category_name); ?></h1>

        <!-- Product Description -->
        <p class="cat-description">
            <?php echo e($data->category_description ?? 'No description available.'); ?>

        </p>

        <!-- Product Barcode -->
        <div class="cat-barcode">
            <span class="barcode"><?php echo e($data->category_barcode); ?></span>
        </div>

        <!-- Product ID -->
        <div class="cat-id">
            <span class="id"><?php echo e($data->categoryid); ?></span>
        </div>
    </div>

</body>

</html>
<?php /**PATH /Users/bijoydey/Desktop/jojobi/resources/views/adminBackend/categories/single_content.blade.php ENDPATH**/ ?>