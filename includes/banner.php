<div class="bg-cover bg-center  h-auto text-white py-24 px-72 object-fill" style="background-image: url(https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80)">
       <div class="md:w-1/2">
        <p class="font-bold text-sm uppercase">RUcrypto</p>
        <p class="text-3xl font-bold"><?php echo $PAGE_TITLE; ?></p>
        <p class="text-2xl mb-10 leading-none">Trade 200 Coins!</p>
        <?php
        if (isset($_SESSION['userid'])) { ?>
<a href="portfolio.php" class="bg-rucrypto py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-rucrypto">Trade Now!</a>

            <?php
        } else { ?>

<a href="signup.php" class="bg-rucrypto py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-rucrypto">Sign Up Now!</a>
<?php
        }
        ?>
        
        </div>  
</div>