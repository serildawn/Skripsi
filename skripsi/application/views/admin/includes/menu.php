<div class="sidebar" data-color="red">
    <div class="logo">
        <a href="<?php echo base_url("Home") ?>" class="simple-text logo-mini">
            PT 
        </a>
        <a href="<?php echo base_url("Home") ?>" class="simple-text logo-normal">
            Sulfatama Kencana 
        </a>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">

        <ul class="nav">
            <li>
                <a href="<?php echo base_url("Home") ?>">
                    <i class="now-ui-icons business_chart-bar-32"></i>
                    <p>Home</p>
                </a>
            </li>
           

            <?php if (user_allow([1,2], false)) : ?>
                <li>
                    <a href="<?php echo base_url("Kios") ?>">
                        <i class="now-ui-icons shopping_shop"></i>
                        <p>Kios</p>
                    </a>
                </li>
            <?php endif ?>
            
            <?php if (user_allow([1,2], false)) : ?>
                <li>
                    <a href="<?php echo base_url("Pupuk") ?>">
                        <i class="now-ui-icons design_app"></i>
                        <p>Pupuk</p>
                    </a>
                </li>
            <?php endif ?>
           
            <?php if (user_allow([1], false)) : ?>
                <li>
                    <a href="<?php echo base_url("Laporan") ?>">
                        <i class="now-ui-icons files_single-copy-04"></i>
                        <p>Laporan Bulanan</p>
                    </a>
                </li>
            <?php endif ?>
            <?php if (user_allow([1,2], false)) : ?>
                <li>
                    <a href="<?php echo base_url("Distribusi") ?>">
                        <i class="now-ui-icons shopping_delivery-fast"></i>
                        <p>Surat Jalan</p>
                    </a>
                </li>
              
            <?php endif ?>
            <?php if (user_allow([1], false)) : ?>
                <li>
                    <a href="<?php echo base_url("Peramalan") ?>">
                        <i class="now-ui-icons education_atom"></i>
                        <p>Peramalan</p>
                    </a>
                </li>
              
            <?php endif ?>
            <?php if (user_allow([1], false)) : ?>
                <li>
                    <a href="<?php echo base_url("Users") ?>">
                        <i class="now-ui-icons users_single-02"></i>
                        <p>User</p>
                    </a>
                </li>
              
            <?php endif ?>
           
            
            
            <li class="active-pro">
                <a href="<?php echo base_url("Logout") ?>">
                    <i class="now-ui-icons ui-1_simple-remove"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>