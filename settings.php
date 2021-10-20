<?php include_once("includes/config.php"); ?>

<?php
    $userPic = "";
    $userEmail = "";
    $userName = "";
    $userUID = "";
    if (isset($_SESSION['userid'])) {
        $userID = $_SESSION['userid'];
        $sql = "SELECT * FROM rucrypto.user
                WHERE user_id='$userID';";
        $result = mysqli_query($conn, $sql) or die("Cant get user settings data");
        
        while ($row = mysqli_fetch_array($result)) {
            $userPic = $row['user_pic'];
            $userEmail = $row['email'];
            $userName = $row['user_fullname'];
            $userUID = $row['user_uid'];
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("includes/head-contents.php"); ?>
</head>
<body>

<?php
include_once("includes/navigation.php");
include_once("includes/banner.php");
?>


<div class="py-10 min-h-full flex items-start justify-center bg-gray-300">

    <div class="flex-initial items-start mr-5 bg-white shadow-md px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-md w-64">    
        <div class="font-medium self-center text-xl sm:text-2xl uppercase text-gray-800">Account</div>
        <div class="mt-10">

            <div class="flex flex-col mb-6">
                <label for="file" class="mb-5 text-xs sm:text-sm tracking-wide text-gray-600">Profile Photo:</label>
                <div class="flex items-center justify-center">
                    <div class="flex-initial mr-10">
                        <div class="flex-wrap w-28 h-28 overflow-hidden relative rounded-full">
                            <img src="<?php echo $_SESSION['userpic']; ?>" class="shadow w-auto mx-auto my-auto h-full align-middle border-none"/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col mb-6">
                <div class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Full Name:</div>
                <div class="relative">
                    <i class="fa fa-user-circle text-gray-500"></i>
                    <?php echo $userName; ?>
                </div>
            </div>
            
            <div class="flex flex-col mb-6">
                <div class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Email:</div>
                <div class="relative">
                    <i class="fa fa-envelope text-gray-500"></i>
                    <?php echo $userEmail; ?>
                </div>
            </div>

            <div class="flex flex-col mb-6">
                <div class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Username:</div>
                <div class="relative">
                    <i class="fa fa-id-card text-gray-500"></i>
                    <?php echo $userUID; ?>
                </div>
            </div>

        </div>
    </div>

    <div class="flex-initial bg-white shadow-md px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-md w-full max-w-md">
        <div class="font-medium self-center text-xl sm:text-2xl uppercase text-gray-800">Update Details</div>
        <div class="mt-10">
        <form action="includes/update-details-action.php" method="post" enctype="multipart/form-data">

            <div class="flex flex-col mb-6">
                <label for="file" class="mb-5 text-xs sm:text-sm tracking-wide text-gray-600">Profile Photo:</label>
                <div class="flex items-center justify-center">
                    <div class="flex-initial mr-10">
                        <label
                        class="w48 flex flex-col items-center px-4 py-6 bg-white rounded-md shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 hover:text-white text-purple-600 ease-linear transition-all duration-150">
                        <i class="fa fa-file fa-3x"></i>
                        <span class="mt-2 text-base leading-normal">Select a file</span>
                        <input type='file' name="file" class="hidden" onchange="loadFile(event)"/>
                        </label>
                    </div>
                    <div class="flex-wrap w-24 h-24 overflow-hidden relative rounded-full">
                        <img id="output" class="shadow w-auto mx-auto my-auto h-full align-middle border-none"/>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col mb-6">
            <label for="name" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Full Name:</label>
            <div class="relative">
                <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.3" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z" />
                </svg>
                </div>

                <input id="name" type="text" name="name" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" placeholder="Full Name" />
            </div>
            </div>

            <div class="flex flex-col mb-6">
            <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Email:</label>
            <div class="relative">
                <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
                </div>

                <input id="email" type="email" name="email" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" placeholder="Email" />
            </div>
            </div>

            <div class="flex flex-col mb-6">
            <label for="uid" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">Username:</label>
            <div class="relative">
                <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                </svg>
                </div>

                <input id="uid" type="text" name="uid" class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" placeholder="Username" />
            </div>
            </div>

            <!-- <div class="flex items-center mb-6 -mt-4">
            <div class="flex ml-auto">
                <a href="#" class="inline-flex text-xs sm:text-sm text-blue-500 hover:text-blue-700">Forgot Your Password?</a>
            </div>
            </div> -->

            <div class="flex w-full">
            <button type="submit" id="submit_update" name="submit_update" class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-rucrypto hover:bg-rucrypto-dark rounded py-2 w-full transition duration-150 ease-in">
                <span class="mr-2 uppercase">Change</span>
                <span>
                <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                </span>
            </button>
            </div>
        </form>
        </div>
        


        <div class="mt-10 font-medium self-center text-xl sm:text-2xl uppercase text-gray-800">DELETE ACCOUNT</div>
        <div class="mt-10">
        <form action="includes/delete-account.php" method="post">
            
            <div class="flex w-full">
                <button onclick="return confirm('Are you sure you want to delete? <?php echo $userName; ?>')" type="submit" id="submit_delete" name="submit_delete" class="flex items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-red-500 hover:bg-red-700 rounded py-2 w-full transition duration-150 ease-in">
                    <span class="mr-2 uppercase">Delete</span>
                    <span>
                    <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    </span>
                </button>
            </div>
        </form>
        </div>

    </div>

</div>


    <?php include_once("includes/footer.php"); ?>

<script>
    var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};
</script>

</body>
</html>