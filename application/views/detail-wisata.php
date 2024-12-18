<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Wisata Cirebon</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <!-- Image and text -->
    <nav class="navbar navbar-light bg-light sticky-top">
        <a class="navbar-brand" href="#">
            <img src="<?php base_url() ;?>assets/img/logo-pemda-full-1024x228.png" height="40" class="d-inline-block align-top mx-5" alt="">
        </a>
    </nav>
    <div>
        <img loading="lazy" width="100%" height="300px" style="object-fit: cover;" src="<?php base_url() ;?>assets/img/heading_figure.png" class="attachment-full size-full" alt="" >
        <h1 style="transform: translateY(-180px);" class="text-center" title="DAYA TARIK WISATA">DAYA TARIK WISATA</h1>
    </div>

    <!-- Main Content  -->
    <div class="container">
        <?php foreach ($current_wisata as $list) : ?>
            <h1 class="mb-4"><?php echo $list->nama; ?></h1>
            <div class="text-justify mb-3"><?php echo $list->deskripsi; ?></div>
            <p>Lokasi : <a href="<?php echo $list->lokasi; ?>" target="_blank"><?php echo $list->lokasi; ?></a></p>
            <br>
        <?php endforeach; ?>
        
        <h2 class="mt-5 mb-3 text-center">Kunjungi Juga</h2>
        <?php $wisata_by_similarity_limited = array_slice($wisata_by_similarity, 0, 5) ;?>
        <?php foreach ($wisata_by_similarity_limited as $list) : ?>
        <table class="table table-hover">
            <tr>
                <span class="h4 pr-3"><?php echo $list->nama; ?></span><span style="background-color: #28a745; border-radius: 1em;" class="px-3 text-white">Kemiripan: <?php echo isset($similarities[$list->id]) ? $similarities[$list->id] * 100 : 0; ?>%</span>
                <td>
                    <img src="<?php echo $list->gambar_preview ;?>" alt="" style="width: 200px; height: auto; border-radius: 1em;" >
                </td>
                <td style="vertical-align: top;" class="px-3 text-justify">
                    <?php echo strlen($list->deskripsi_display) > 50 ? substr($list->deskripsi_display, 0, 500) . '...' : $list->deskripsi; ?>
                    <a href="<?php echo base_url('wisata/detail_wisata/' . $list->id); ?>">Baca lebih lanjut</a>
                </td>
                    <td colspan="2">
                        
                    </td>
            </tr>
        </table>
        <?php endforeach; ?>

        <h2 class="mt-5 mb-3 text-center">Wisata Terdekat</h2>
        <?php $wisata_by_location_limited = array_slice($wisata_by_location, 0, 5) ;?>
        <?php foreach ($wisata_by_location_limited as $wisata): ?> 
        <table class="table table-hover">
            <tr>
                <span class="h4 pr-3"><?php echo $wisata->nama; ?></span><span style="background-color: #FF5733; border-radius: 1em;" class="px-3 text-white">Jarak: <?= round($wisata->distance, 2); ?> km<br></span>
                <td>
                    <img src="<?php echo $wisata->gambar_preview; ?>" alt="" style="width: 200px; height: auto; border-radius: 1em;">
                </td>
                <td style="vertical-align: top;" class="px-3 text-justify">
                    <?php echo strlen($wisata->deskripsi_display) > 50 ? substr($wisata->deskripsi_display, 0, 500) . '...' : $wisata->deskripsi; ?>
                    <a href="<?php echo base_url('wisata/detail_wisata/' . $wisata->id); ?>">Baca lebih lanjut</a>
                </td>
            </tr>
        </table>
        <?php endforeach; ?>

        
    
    </div>

</body>
</html>