<?php
$loggedIn = false;
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['fname']) && isset($_SESSION['lname'])) {
	$loggedIn = true;
}
?>

<!DOCTYPE html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Shankhnaad'20 - Home</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
	<link rel="stylesheet" href="/assets/css/index.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="shortcut icon" type="image/png" href="img/shankh-black.png"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
	<script src="https://kit.fontawesome.com/6c05aa3d79.js" crossorigin="anonymous"></script>
	<script defer src="/assets/scripts/index.js"></script>
</head>

<body>

	<!--Pre-Loader-->
	<div class="loader-wrapper">
		<svg id="logo" viewBox="0 0 973 119" fill="none" xmlns="http://www.w3.org/2000/svg">
			<mask id="path-1-outside-1" maskUnits="userSpaceOnUse" x="-0.791992" y="0.440002" width="973" height="118" fill="black">
			<rect fill="white" x="-0.791992" y="0.440002" width="973" height="118"/>
			<path d="M39.912 113.008C33.288 113.008 27.336 111.856 22.056 109.552C16.872 107.152 12.792 103.888 9.81601 99.76C6.84001 95.536 5.30401 90.688 5.20801 85.216H19.176C19.656 89.92 21.576 93.904 24.936 97.168C28.392 100.336 33.384 101.92 39.912 101.92C46.152 101.92 51.048 100.384 54.6 97.312C58.248 94.144 60.072 90.112 60.072 85.216C60.072 81.376 59.016 78.256 56.904 75.856C54.792 73.456 52.152 71.632 48.984 70.384C45.816 69.136 41.544 67.792 36.168 66.352C29.544 64.624 24.216 62.896 20.184 61.168C16.248 59.44 12.84 56.752 9.96001 53.104C7.17601 49.36 5.78401 44.368 5.78401 38.128C5.78401 32.656 7.17601 27.808 9.96001 23.584C12.744 19.36 16.632 16.096 21.624 13.792C26.712 11.488 32.52 10.336 39.048 10.336C48.456 10.336 56.136 12.688 62.088 17.392C68.136 22.096 71.544 28.336 72.312 36.112H57.912C57.432 32.272 55.416 28.912 51.864 26.032C48.312 23.056 43.608 21.568 37.752 21.568C32.28 21.568 27.816 23.008 24.36 25.888C20.904 28.672 19.176 32.608 19.176 37.696C19.176 41.344 20.184 44.32 22.2 46.624C24.312 48.928 26.856 50.704 29.832 51.952C32.904 53.104 37.176 54.448 42.648 55.984C49.272 57.808 54.6 59.632 58.632 61.456C62.664 63.184 66.12 65.92 69 69.664C71.88 73.312 73.32 78.304 73.32 84.64C73.32 89.536 72.024 94.144 69.432 98.464C66.84 102.784 63 106.288 57.912 108.976C52.824 111.664 46.824 113.008 39.912 113.008Z"/>
			<path d="M138.972 31.648C144.924 31.648 150.3 32.944 155.1 35.536C159.9 38.032 163.644 41.824 166.332 46.912C169.116 52 170.508 58.192 170.508 65.488V112H157.548V67.36C157.548 59.488 155.58 53.488 151.644 49.36C147.708 45.136 142.332 43.024 135.516 43.024C128.604 43.024 123.084 45.184 118.956 49.504C114.924 53.824 112.908 60.112 112.908 68.368V112H99.8036V5.44H112.908V44.32C115.5 40.288 119.052 37.168 123.564 34.96C128.172 32.752 133.308 31.648 138.972 31.648Z"/>
			<path d="M194.217 72.256C194.217 64.192 195.849 57.136 199.113 51.088C202.377 44.944 206.841 40.192 212.505 36.832C218.265 33.472 224.649 31.792 231.657 31.792C238.569 31.792 244.569 33.28 249.657 36.256C254.745 39.232 258.537 42.976 261.033 47.488V33.088H274.281V112H261.033V97.312C258.441 101.92 254.553 105.76 249.369 108.832C244.281 111.808 238.329 113.296 231.513 113.296C224.505 113.296 218.169 111.568 212.505 108.112C206.841 104.656 202.377 99.808 199.113 93.568C195.849 87.328 194.217 80.224 194.217 72.256ZM261.033 72.4C261.033 66.448 259.833 61.264 257.433 56.848C255.033 52.432 251.769 49.072 247.641 46.768C243.609 44.368 239.145 43.168 234.249 43.168C229.353 43.168 224.889 44.32 220.857 46.624C216.825 48.928 213.609 52.288 211.209 56.704C208.809 61.12 207.609 66.304 207.609 72.256C207.609 78.304 208.809 83.584 211.209 88.096C213.609 92.512 216.825 95.92 220.857 98.32C224.889 100.624 229.353 101.776 234.249 101.776C239.145 101.776 243.609 100.624 247.641 98.32C251.769 95.92 255.033 92.512 257.433 88.096C259.833 83.584 261.033 78.352 261.033 72.4Z"/>
			<path d="M342.074 31.648C351.674 31.648 359.45 34.576 365.402 40.432C371.354 46.192 374.329 54.544 374.329 65.488V112H361.37V67.36C361.37 59.488 359.402 53.488 355.466 49.36C351.53 45.136 346.153 43.024 339.337 43.024C332.425 43.024 326.905 45.184 322.777 49.504C318.745 53.824 316.73 60.112 316.73 68.368V112H303.626V33.088H316.73V44.32C319.322 40.288 322.826 37.168 327.242 34.96C331.754 32.752 336.698 31.648 342.074 31.648Z"/>
			<path d="M446.999 112L416.039 77.152V112H402.935V5.44H416.039V68.08L446.423 33.088H464.711L427.559 72.4L464.855 112H446.999Z"/>
			<path d="M523.412 31.648C529.364 31.648 534.74 32.944 539.54 35.536C544.34 38.032 548.084 41.824 550.772 46.912C553.556 52 554.948 58.192 554.948 65.488V112H541.988V67.36C541.988 59.488 540.02 53.488 536.084 49.36C532.148 45.136 526.772 43.024 519.956 43.024C513.044 43.024 507.524 45.184 503.396 49.504C499.364 53.824 497.348 60.112 497.348 68.368V112H484.244V5.44H497.348V44.32C499.94 40.288 503.492 37.168 508.004 34.96C512.612 32.752 517.748 31.648 523.412 31.648Z"/>
			<path d="M622.002 31.648C631.602 31.648 639.378 34.576 645.33 40.432C651.282 46.192 654.258 54.544 654.258 65.488V112H641.298V67.36C641.298 59.488 639.33 53.488 635.394 49.36C631.458 45.136 626.082 43.024 619.266 43.024C612.354 43.024 606.834 45.184 602.706 49.504C598.674 53.824 596.658 60.112 596.658 68.368V112H583.554V33.088H596.658V44.32C599.25 40.288 602.754 37.168 607.17 34.96C611.682 32.752 616.626 31.648 622.002 31.648Z"/>
			<path d="M677.967 72.256C677.967 64.192 679.599 57.136 682.863 51.088C686.127 44.944 690.591 40.192 696.255 36.832C702.015 33.472 708.399 31.792 715.407 31.792C722.319 31.792 728.319 33.28 733.407 36.256C738.495 39.232 742.287 42.976 744.783 47.488V33.088H758.031V112H744.783V97.312C742.191 101.92 738.303 105.76 733.119 108.832C728.031 111.808 722.079 113.296 715.263 113.296C708.255 113.296 701.919 111.568 696.255 108.112C690.591 104.656 686.127 99.808 682.863 93.568C679.599 87.328 677.967 80.224 677.967 72.256ZM744.783 72.4C744.783 66.448 743.583 61.264 741.183 56.848C738.783 52.432 735.519 49.072 731.391 46.768C727.359 44.368 722.895 43.168 717.999 43.168C713.103 43.168 708.639 44.32 704.607 46.624C700.575 48.928 697.359 52.288 694.959 56.704C692.559 61.12 691.359 66.304 691.359 72.256C691.359 78.304 692.559 83.584 694.959 88.096C697.359 92.512 700.575 95.92 704.607 98.32C708.639 100.624 713.103 101.776 717.999 101.776C722.895 101.776 727.359 100.624 731.391 98.32C735.519 95.92 738.783 92.512 741.183 88.096C743.583 83.584 744.783 78.352 744.783 72.4Z"/>
			<path d="M782.479 72.256C782.479 64.192 784.111 57.136 787.375 51.088C790.639 44.944 795.103 40.192 800.767 36.832C806.527 33.472 812.911 31.792 819.919 31.792C826.831 31.792 832.831 33.28 837.919 36.256C843.007 39.232 846.799 42.976 849.295 47.488V33.088H862.543V112H849.295V97.312C846.703 101.92 842.815 105.76 837.631 108.832C832.543 111.808 826.591 113.296 819.775 113.296C812.767 113.296 806.431 111.568 800.767 108.112C795.103 104.656 790.639 99.808 787.375 93.568C784.111 87.328 782.479 80.224 782.479 72.256ZM849.295 72.4C849.295 66.448 848.095 61.264 845.695 56.848C843.295 52.432 840.032 49.072 835.904 46.768C831.872 44.368 827.407 43.168 822.511 43.168C817.615 43.168 813.152 44.32 809.12 46.624C805.088 48.928 801.871 52.288 799.471 56.704C797.071 61.12 795.871 66.304 795.871 72.256C795.871 78.304 797.071 83.584 799.471 88.096C801.871 92.512 805.088 95.92 809.12 98.32C813.152 100.624 817.615 101.776 822.511 101.776C827.407 101.776 831.872 100.624 835.904 98.32C840.032 95.92 843.295 92.512 845.695 88.096C848.095 83.584 849.295 78.352 849.295 72.4Z"/>
			<path d="M886.992 72.256C886.992 64.192 888.624 57.136 891.888 51.088C895.152 44.944 899.616 40.192 905.28 36.832C911.04 33.472 917.472 31.792 924.576 31.792C930.72 31.792 936.432 33.232 941.712 36.112C946.992 38.896 951.024 42.592 953.808 47.2V5.44H967.056V112H953.808V97.168C951.216 101.872 947.376 105.76 942.288 108.832C937.2 111.808 931.248 113.296 924.432 113.296C917.424 113.296 911.04 111.568 905.28 108.112C899.616 104.656 895.152 99.808 891.888 93.568C888.624 87.328 886.992 80.224 886.992 72.256ZM953.808 72.4C953.808 66.448 952.608 61.264 950.208 56.848C947.808 52.432 944.544 49.072 940.416 46.768C936.384 44.368 931.92 43.168 927.024 43.168C922.128 43.168 917.664 44.32 913.632 46.624C909.6 48.928 906.384 52.288 903.984 56.704C901.584 61.12 900.384 66.304 900.384 72.256C900.384 78.304 901.584 83.584 903.984 88.096C906.384 92.512 909.6 95.92 913.632 98.32C917.664 100.624 922.128 101.776 927.024 101.776C931.92 101.776 936.384 100.624 940.416 98.32C944.544 95.92 947.808 92.512 950.208 88.096C952.608 83.584 953.808 78.352 953.808 72.4Z"/>
			</mask>
			<path d="M39.912 113.008C33.288 113.008 27.336 111.856 22.056 109.552C16.872 107.152 12.792 103.888 9.81601 99.76C6.84001 95.536 5.30401 90.688 5.20801 85.216H19.176C19.656 89.92 21.576 93.904 24.936 97.168C28.392 100.336 33.384 101.92 39.912 101.92C46.152 101.92 51.048 100.384 54.6 97.312C58.248 94.144 60.072 90.112 60.072 85.216C60.072 81.376 59.016 78.256 56.904 75.856C54.792 73.456 52.152 71.632 48.984 70.384C45.816 69.136 41.544 67.792 36.168 66.352C29.544 64.624 24.216 62.896 20.184 61.168C16.248 59.44 12.84 56.752 9.96001 53.104C7.17601 49.36 5.78401 44.368 5.78401 38.128C5.78401 32.656 7.17601 27.808 9.96001 23.584C12.744 19.36 16.632 16.096 21.624 13.792C26.712 11.488 32.52 10.336 39.048 10.336C48.456 10.336 56.136 12.688 62.088 17.392C68.136 22.096 71.544 28.336 72.312 36.112H57.912C57.432 32.272 55.416 28.912 51.864 26.032C48.312 23.056 43.608 21.568 37.752 21.568C32.28 21.568 27.816 23.008 24.36 25.888C20.904 28.672 19.176 32.608 19.176 37.696C19.176 41.344 20.184 44.32 22.2 46.624C24.312 48.928 26.856 50.704 29.832 51.952C32.904 53.104 37.176 54.448 42.648 55.984C49.272 57.808 54.6 59.632 58.632 61.456C62.664 63.184 66.12 65.92 69 69.664C71.88 73.312 73.32 78.304 73.32 84.64C73.32 89.536 72.024 94.144 69.432 98.464C66.84 102.784 63 106.288 57.912 108.976C52.824 111.664 46.824 113.008 39.912 113.008Z" stroke="white" stroke-width="10" mask="url(#path-1-outside-1)"/>
			<path d="M138.972 31.648C144.924 31.648 150.3 32.944 155.1 35.536C159.9 38.032 163.644 41.824 166.332 46.912C169.116 52 170.508 58.192 170.508 65.488V112H157.548V67.36C157.548 59.488 155.58 53.488 151.644 49.36C147.708 45.136 142.332 43.024 135.516 43.024C128.604 43.024 123.084 45.184 118.956 49.504C114.924 53.824 112.908 60.112 112.908 68.368V112H99.8036V5.44H112.908V44.32C115.5 40.288 119.052 37.168 123.564 34.96C128.172 32.752 133.308 31.648 138.972 31.648Z" stroke="white" stroke-width="10" mask="url(#path-1-outside-1)"/>
			<path d="M194.217 72.256C194.217 64.192 195.849 57.136 199.113 51.088C202.377 44.944 206.841 40.192 212.505 36.832C218.265 33.472 224.649 31.792 231.657 31.792C238.569 31.792 244.569 33.28 249.657 36.256C254.745 39.232 258.537 42.976 261.033 47.488V33.088H274.281V112H261.033V97.312C258.441 101.92 254.553 105.76 249.369 108.832C244.281 111.808 238.329 113.296 231.513 113.296C224.505 113.296 218.169 111.568 212.505 108.112C206.841 104.656 202.377 99.808 199.113 93.568C195.849 87.328 194.217 80.224 194.217 72.256ZM261.033 72.4C261.033 66.448 259.833 61.264 257.433 56.848C255.033 52.432 251.769 49.072 247.641 46.768C243.609 44.368 239.145 43.168 234.249 43.168C229.353 43.168 224.889 44.32 220.857 46.624C216.825 48.928 213.609 52.288 211.209 56.704C208.809 61.12 207.609 66.304 207.609 72.256C207.609 78.304 208.809 83.584 211.209 88.096C213.609 92.512 216.825 95.92 220.857 98.32C224.889 100.624 229.353 101.776 234.249 101.776C239.145 101.776 243.609 100.624 247.641 98.32C251.769 95.92 255.033 92.512 257.433 88.096C259.833 83.584 261.033 78.352 261.033 72.4Z" stroke="white" stroke-width="10" mask="url(#path-1-outside-1)"/>
			<path d="M342.074 31.648C351.674 31.648 359.45 34.576 365.402 40.432C371.354 46.192 374.329 54.544 374.329 65.488V112H361.37V67.36C361.37 59.488 359.402 53.488 355.466 49.36C351.53 45.136 346.153 43.024 339.337 43.024C332.425 43.024 326.905 45.184 322.777 49.504C318.745 53.824 316.73 60.112 316.73 68.368V112H303.626V33.088H316.73V44.32C319.322 40.288 322.826 37.168 327.242 34.96C331.754 32.752 336.698 31.648 342.074 31.648Z" stroke="white" stroke-width="10" mask="url(#path-1-outside-1)"/>
			<path d="M446.999 112L416.039 77.152V112H402.935V5.44H416.039V68.08L446.423 33.088H464.711L427.559 72.4L464.855 112H446.999Z" stroke="white" stroke-width="10" mask="url(#path-1-outside-1)"/>
			<path d="M523.412 31.648C529.364 31.648 534.74 32.944 539.54 35.536C544.34 38.032 548.084 41.824 550.772 46.912C553.556 52 554.948 58.192 554.948 65.488V112H541.988V67.36C541.988 59.488 540.02 53.488 536.084 49.36C532.148 45.136 526.772 43.024 519.956 43.024C513.044 43.024 507.524 45.184 503.396 49.504C499.364 53.824 497.348 60.112 497.348 68.368V112H484.244V5.44H497.348V44.32C499.94 40.288 503.492 37.168 508.004 34.96C512.612 32.752 517.748 31.648 523.412 31.648Z" stroke="white" stroke-width="10" mask="url(#path-1-outside-1)"/>
			<path d="M622.002 31.648C631.602 31.648 639.378 34.576 645.33 40.432C651.282 46.192 654.258 54.544 654.258 65.488V112H641.298V67.36C641.298 59.488 639.33 53.488 635.394 49.36C631.458 45.136 626.082 43.024 619.266 43.024C612.354 43.024 606.834 45.184 602.706 49.504C598.674 53.824 596.658 60.112 596.658 68.368V112H583.554V33.088H596.658V44.32C599.25 40.288 602.754 37.168 607.17 34.96C611.682 32.752 616.626 31.648 622.002 31.648Z" stroke="white" stroke-width="10" mask="url(#path-1-outside-1)"/>
			<path d="M677.967 72.256C677.967 64.192 679.599 57.136 682.863 51.088C686.127 44.944 690.591 40.192 696.255 36.832C702.015 33.472 708.399 31.792 715.407 31.792C722.319 31.792 728.319 33.28 733.407 36.256C738.495 39.232 742.287 42.976 744.783 47.488V33.088H758.031V112H744.783V97.312C742.191 101.92 738.303 105.76 733.119 108.832C728.031 111.808 722.079 113.296 715.263 113.296C708.255 113.296 701.919 111.568 696.255 108.112C690.591 104.656 686.127 99.808 682.863 93.568C679.599 87.328 677.967 80.224 677.967 72.256ZM744.783 72.4C744.783 66.448 743.583 61.264 741.183 56.848C738.783 52.432 735.519 49.072 731.391 46.768C727.359 44.368 722.895 43.168 717.999 43.168C713.103 43.168 708.639 44.32 704.607 46.624C700.575 48.928 697.359 52.288 694.959 56.704C692.559 61.12 691.359 66.304 691.359 72.256C691.359 78.304 692.559 83.584 694.959 88.096C697.359 92.512 700.575 95.92 704.607 98.32C708.639 100.624 713.103 101.776 717.999 101.776C722.895 101.776 727.359 100.624 731.391 98.32C735.519 95.92 738.783 92.512 741.183 88.096C743.583 83.584 744.783 78.352 744.783 72.4Z" stroke="white" stroke-width="10" mask="url(#path-1-outside-1)"/>
			<path d="M782.479 72.256C782.479 64.192 784.111 57.136 787.375 51.088C790.639 44.944 795.103 40.192 800.767 36.832C806.527 33.472 812.911 31.792 819.919 31.792C826.831 31.792 832.831 33.28 837.919 36.256C843.007 39.232 846.799 42.976 849.295 47.488V33.088H862.543V112H849.295V97.312C846.703 101.92 842.815 105.76 837.631 108.832C832.543 111.808 826.591 113.296 819.775 113.296C812.767 113.296 806.431 111.568 800.767 108.112C795.103 104.656 790.639 99.808 787.375 93.568C784.111 87.328 782.479 80.224 782.479 72.256ZM849.295 72.4C849.295 66.448 848.095 61.264 845.695 56.848C843.295 52.432 840.032 49.072 835.904 46.768C831.872 44.368 827.407 43.168 822.511 43.168C817.615 43.168 813.152 44.32 809.12 46.624C805.088 48.928 801.871 52.288 799.471 56.704C797.071 61.12 795.871 66.304 795.871 72.256C795.871 78.304 797.071 83.584 799.471 88.096C801.871 92.512 805.088 95.92 809.12 98.32C813.152 100.624 817.615 101.776 822.511 101.776C827.407 101.776 831.872 100.624 835.904 98.32C840.032 95.92 843.295 92.512 845.695 88.096C848.095 83.584 849.295 78.352 849.295 72.4Z" stroke="white" stroke-width="10" mask="url(#path-1-outside-1)"/>
			<path d="M886.992 72.256C886.992 64.192 888.624 57.136 891.888 51.088C895.152 44.944 899.616 40.192 905.28 36.832C911.04 33.472 917.472 31.792 924.576 31.792C930.72 31.792 936.432 33.232 941.712 36.112C946.992 38.896 951.024 42.592 953.808 47.2V5.44H967.056V112H953.808V97.168C951.216 101.872 947.376 105.76 942.288 108.832C937.2 111.808 931.248 113.296 924.432 113.296C917.424 113.296 911.04 111.568 905.28 108.112C899.616 104.656 895.152 99.808 891.888 93.568C888.624 87.328 886.992 80.224 886.992 72.256ZM953.808 72.4C953.808 66.448 952.608 61.264 950.208 56.848C947.808 52.432 944.544 49.072 940.416 46.768C936.384 44.368 931.92 43.168 927.024 43.168C922.128 43.168 917.664 44.32 913.632 46.624C909.6 48.928 906.384 52.288 903.984 56.704C901.584 61.12 900.384 66.304 900.384 72.256C900.384 78.304 901.584 83.584 903.984 88.096C906.384 92.512 909.6 95.92 913.632 98.32C917.664 100.624 922.128 101.776 927.024 101.776C931.92 101.776 936.384 100.624 940.416 98.32C944.544 95.92 947.808 92.512 950.208 88.096C952.608 83.584 953.808 78.352 953.808 72.4Z" stroke="white" stroke-width="10" mask="url(#path-1-outside-1)"/>
		</svg>
	</div>

	<script>
		$(window).on("load",function(){
			$(".loader-wrapper").fadeOut("slow");
		});
	</script>
	<!--End Preloader-->

	<!--- Start Navigation -->
	<nav>
		<div class="nav-logo">
			<img src="./img/shankh-white.svg">
			<h1>Shankhnaad'20</h1>
		</div>
		<ul class="nav-ul" id="nav">
			<?php
				if ($loggedIn) echo "<li><a class=\"nav-ul-a\" href=\"/dashboard\">Dashboard</a></li>";
				else echo "<li><a class=\"nav-ul-a\" href=\"/login\">Login</a></li>"
			?>
			<li><a class="nav-ul-a" href="/biofest">Bio-Fest 2020</a></li>
			<li><a class="nav-ul-a" href="/#events">Events</a></li>
			<li><a id="brochure" class="nav-ul-a" href="" target="_blank">Brochure</a></li>
			<!--li><a class="nav-ul-a" href="/#executive-comitee">Mentors</a></li-->
			<li><a class="nav-ul-a" href="/#testimonials">Testimonials</a></li>
			<li><a class="nav-ul-a" href="/#sponsors">Sponsors</a></li>
			<li><a class="nav-ul-a" href="/#about-us">About us</a></li>
		</ul>
		<div class="burger">
			<div class="line1"></div>
			<div class="line2"></div>
			<div class="line3"></div>
		</div>
	</nav>
	<!--- End Navigation -->
	
	<!--Start Home-->
	<a name="home">
		<!--- Start Slider -->
		<script>
			$(document).ready(function() {
				$('.slider').bxSlider({
					mode: 'fade',
					controls: false,
					auto: true,
					pager: false,
					responsive: true
				});
			});
		</script>
		<div class="slider">
			<div><img src="img/img-1.jpg"></div>
			<div><img src="img/img-2.jpg"></div>
			<div><img src="img/img-3.jpg"></div>
			<div><img src="img/img-4.jpg"></div>
			<div><img src="img/img-5.jpg"></div>
		</div>
		<!--- End Slider -->
	</a>
	<!--End Home-->

	<!--Start Parallax 1 Section-->
	<section class="parallax" id="parallax-intro">
		<div class="parallax-inner">
			<blockquote id="shankhnaad-intro">The blare of the conch shell, herald victory, embarking the start of a new venture, with this ethos, we the people of AITH welcome you to our sumptuous Annual Techno-Cultural and Literary fest. SHANKHNAAD. This will be a feast to your soul and mind. With all the novice celebration, it will be a memorable episode. With the adventure of treasure hunt, to the humor of stand-up comedy, and wrapped with the grace of soulful music, it will be an extravaganza experience. Do join us to celebrate your joy to the fullest and give a try to this happening occurrence.</blockquote>
		</div>
	</section>
	<!--End Parallax 1 Section-->

	<!--Start Events-->
	<a id="events" name="events">
		<!--Start Banner Wrapper For Events-->
		<div class="banner-wrapper">
			<h1>This Year's Events</h1>
			<section class="one-third">
				<img src="img/technical.jpg">
				<h3>Technical</h3>
				<p>Technology helps us to step into this new era with ease, and engineers are known as the wizard of technology. So a shout out to all the technocrats out there here, it is big feed for all of you as you'll get a blow of microflora art to PC gaming. Check your expertise with us and adore these festivities.</p>
				<a class="event-button" href="/events/technical/" target="_blank">See Technical Events</a>
				<!--button onclick="window.location.href = '/events/technical/';">See Events</button-->
			</section>
			<section class="one-third">
				<img src="img/literature.jpg">
				<h3>Literary</h3>
				<p>We all somewhere empty our way too filled mind with our artistic qualities hidden somewhere within us. So it's high time to do it more skillfully. Process, nothing much shows the grace of eloquent mindset and content you have, and that's it. Come with us to this beautiful expedition and manifest your finesse.</p>
				<a class="event-button" href="events/literary/" target="_blank">See Literary Events</a>
				<!--button onclick="window.location.href = 'events/literary/'; window.location.target = '_blank';">See Events</button-->
			</section>
			<section class="one-third">
				<img src="img/cultural.jpg">
				<h3>Cultural</h3>
				<p>It will be very sketchy without a touch of music, dance and some adventure. So to give this trip an extra dose of happiness and enthusiasm, we present you the elegance of the cultural interlude. From classical dance to hip hop, it just contains each and everything to palliate you. So Gather to the arena and play a part in this delight.</p>
				<a class="event-button" href="/events/cultural/" target="_blank">See Cultural Events</a>
				<!--button onclick="window.location.href = 'events/cultural/';">See Events</button-->
			</section>
		</div>
		<!--End Banner Wrapper-->
	</a>
	<!--End Events-->

	<div class="clearfix"></div>

	<!--Start Empty Parallax Section-->
	<section class="parallax" id="parallax-empty">
		<div class="parallax-inner">
		</div>
	</section>
	<!--End Empty Parallax Section-->

	<div class="clear-fix"></div>

	<!--Start Mentors-->
	<a id="executive-comitee" name="executive-comitee">
		<!--Start Banner Wrapper For Teams-->
		<div class="banner-wrapper">
			<h1>Executive Committee</h1>
			<div class="one-third">
				<img src="img/mentor-1.png" alt="" width="100px" height="auto" style="border-radius: 50%;">
				<figcaption>Sri Nath Dwivedi<br>(Chairman CECA)</figcaption>
			</div>
			<div class="one-third">
				<img src="img/mentor-2.png" alt="" width="100px" height="auto" style="border-radius: 50%;">
				<figcaption>Dr. Anuj Srivastva<br>(Cultural Convenor)</figcaption>
			</div>
			<div class="one-third">
				<img src="img/mentor-3.png" alt="" width="100px" height="auto" style="border-radius: 50%;">
				<figcaption>Kapil Kumar Pandey<br>(Technical and Literary Convenor)</figcaption>
			</div>
		</div>
		<!--End Banner Wrapper For Teams-->
	</a>
	<!--End Teams-->

	<div class="clearfix"></div>

	<!--Start Empty Parallax Section-->
	<section class="parallax" id="parallax-empty">
		<div class="parallax-inner">
		</div>
	</section>
	<!--End Empty Parallax Section-->

	<div class="clearfix"></div>

	<!--Start Testimonials-->
	<a id="testimonials" name="testimonials">
		<!--Start Banner Wrapper For Teams-->
		<div class="banner-wrapper">
			<div class="testimonial-section">
				<div class="inner-width">
					<h1>Testimonials</h1>
					<div class="testimonial-pics">
						<img src="img/test-1.jpg" alt="test-1" class="active">
						<img src="img/test-2.jpg" alt="test-2">
						<img src="img/test-3.jpg" alt="test-3">
					</div>

					<div class="testimonial-contents">
						<div class="testimonial active" id="test-1">
						<p>"The rate at which this college is enhancing makes me feel so proud. I am awestruck by these beautiful performances."</p>
						<span class="description">
							<h3 class="name">Prof. Vinay Kumar Pathak</h3>
							<h6>Vice Chancellor<br>AKTU, Lucknow</h6>
						</span>
						</div>

						<div class="testimonial" id="test-2">
						<p>"To see physically challenged students performing so well makes me astound. It was a memorable episode to experience."</p>
						<span class="description">
							<h3 class="name">Ira Singhal</h3>
							<h6>Deputy Commissionor<br>Nagar Nigam, North Delhi</h6>
						</span>
						</div>

						<div class="testimonial" id="test-3">
							<p>"To see this joyous gathering, even instrument beats are most elated. Thank you for the top musical experience and a wonderful night!"</p>
							<span class="description">
								<h3 class="name">Ankesh Jha</h3>
								<h6>Lead Singer<br>The Mixtape Band</h6>
						</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
    		$('.testimonial-pics img').click(function(){
        	$(".testimonial-pics img").removeClass("active");
        	$(this).addClass("active");
        	$(".testimonial").removeClass("active");
        	$("#"+$(this).attr("alt")).addClass("active");
      		});
    	</script>
		<!--End Banner Wrapper For Testimonials-->
	</a>
	<!--End Testimonials-->

	<div class="clearfix"></div>

	<!--Start Empty Parallax Section-->
	<section class="parallax" id="parallax-empty">
		<div class="parallax-inner">
		</div>
	</section>
	<!--End Empty Parallax Section-->

	<div class="clearfix"></div>

	<!--Start Sponsors-->
	<a id="sponsors" name="sponsors">
		<!--Start Banner Wrapper For Sponsors-->
		<div class="banner-wrapper">
			<h1>Our Sponsors</h1>
			<img src="img/sponsors.jpg" alt="" width="60%" height="auto" class="image-center" id="img-sponsors">
		</div>
		<!--End Banner Wrapper For Teams-->
	</a>
	<!--End Sponsors-->

	<div class="clearfix"></div>

	<!--Start Empty Parallax Section-->
	<section class="parallax" id="parallax-empty">
		<div class="parallax-inner">
		</div>
	</section>
	<!--End Empty Parallax Section-->

	<div class="clearfix"></div>

	<!--Start About Us-->
	<a id="about-us" name="aboutus">
		<!--Start Banner Wrapper-->
		<section class="left-col">
			<h1>About Us</h1>
			<p>Dr. Ambedkar Institute of Technology for Handicapped, Kanpur with the motto of "न दैन्यम् न पलायनम्" is again ready to bring along all of you and rejuvenate you with an extreme amount of pure happiness and ecstasy. The annual socio-cultural event Shankhnaad 2020 is waiting at your doorstep to incarnate the memories which last a lifetime.</p>
			<p>So, let us give ourselves this eternal essence of incredible human experience with an enchanting fusion of a three-day-long literary, musical, and artistic events and have an escape from all the bitterness in life. Embrace yourself for another cultural extravaganza.</p>
			<div class="quotation">
				<h4>"उठे जो स्वर तो अच्छा है,<br>पर उठे, आज धीमे ही सही,<br>मिलकर जो आएगी आवाज़,<br>तो गूंजेगा शंखनाद भी यहीं।"</h4>
			</div>
		</section>
		<section class="sidebar">
			<img id="img-college" src="img/college.jpg">
		</section>
		<!--End Banner Wrapper-->
	</a>
	<!--End About Us-->

	<div class="clearfix"></div>

	<!--Start Footer-->
	<footer>
		<div class="footer-content">
			<div class="col" id="main">
				<h3>Team</a></h3>
				<ul>
					<li><a href="#">Management</a></li>
					<li><a href="#">Developer</a></li>
					<li><a href="#">Content Creator</a></li>
				</ul>
				<br>
				<h3>Media</h3>
				<ul>
					<li><a id="footer-brochure" href="" target="_blank">Brochure</a></li>
					<li><a href="gallery.html" target="_blank">Gallery</a></li>
					<!--li><a href="#">After Movie</a></li-->
				</ul>
				<br>
				<h3>Contact Us</h3>
				<ul>
					<li><a href="mailto:shankhnaad@aith.ac.in" style="color: rgba(255,255,255,0.75);">shankhnaad@aith.ac.in</a></li>
					<!--li><li-->
				</ul>
				<br>
				<h3>Connect With US</h3>
				<div id="social-media-icons">
				<a class="fab fa-facebook-f" href="https://www.facebook.com/shankhnaadAITH" target="_blank"></a>
				<a class="fab fa-instagram" href="https://www.instagram.com/shankhnaadAITH/" target="_blank"></a>
				<a class="fab fa-youtube" href="https://www.youtube.com/shankhnaadAITH" target="_blank"></a>
			</div>
			</div>
			<div class="col" id="map">
				<iframe width="100%" height="100%" src="https://maps.google.com/maps?width=700&amp;height=440&amp;hl=en&amp;q=Dr.%20Ambedkar%20Institute%20of%20Technology%20for%20Handicapped+(Dr.%20Ambedkar%20Institute%20of%20Technology%20for%20Handicapped)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
				<style>
					#gmap_canvas img {
						max-width: none !important;
						background: none !important
					}
				</style>
			</div>
		</div>
		<div id="footer-end-text">
			Developed by HumbleFool Club.<br>
			Copyright &copy; 2020 Shankhnaad. All rights reserved.<br><br>
			Dr. Ambedkar Institute Of Technology For Handicapped,<br>
			Awadhpuri, Kanpur - 208024
		</div>
	</footer>
</body>

</html>