<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Wisata Cirebon</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
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
    <center><h1 class="mb-5">Daftar Wisata Kota Cirebon</h1></center>

    <!-- Main Content  -->
    <div class="container">
        <?php $no = 1; foreach ($wisata_list as $list) : ?>
            <h2><?php echo $no . '. ' . htmlspecialchars($list->nama); ?></h2>
                <table>
                    <tr>
                        <td>
                            <img src="<?php echo $list->gambar_preview ;?>" alt="" style="width: 200px; height: auto; border-radius: 1em;" >
                        </td>
                        <td style="vertical-align: top;" class="px-3 text-justify">
                            <?php echo strlen($list->deskripsi_display) > 50 ? substr($list->deskripsi_display, 0, 500) . '...' : $list->deskripsi; ?>
                            <a href="<?php echo base_url('wisata/detail_wisata/' . $list->id); ?>">Baca lebih lanjut</a>
                        </td>
                    </tr>
                </table>
            <br>
        <?php $no++; endforeach; ?>
    </div>

    <div class=></div>
</body>
</html>