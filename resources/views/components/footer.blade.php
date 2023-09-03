{{-- <div class="footer-wrapper" style="position: fixed; bottom: 0; z-index: -1">
    <div class="footer-section f-section-1">
        <p class="">Copyright © <span class="dynamic-year">2023</span> <a href="#" style="color: blue">Golden
                Soft</a>, All rights reserved.</p>
    </div>
</div> --}}

<style>
    .footer-container {
        position: fixed;
        bottom: -50px;
        /* Set the initial position below the viewport */
        left: 0;
        right: 0;
        background-color: #f0f0f0;
        /* Set your desired background color */
        z-index: 999;
        /* Adjust the z-index as needed to control stacking order */
        transition: bottom 0.3s ease;
        /* Add smooth transition effect */
    }
</style>

<div class="footer-container">
    <div class="footer-wrapper">
        <div class="footer-section f-section-1">
            <p class="">Copyright © <span class="dynamic-year">2023</span> <a href="#"
                    style="color: blue">Golden Soft</a>, All rights reserved.</p>
        </div>
    </div>
</div>

<script>
    window.addEventListener('scroll', function() {
        var footerContainer = document.querySelector('.footer-container');
        var scrollY = window.scrollY;

        // Set the desired threshold for the scroll trigger
        var scrollThreshold = 100;

        if (scrollY > scrollThreshold) {
            footerContainer.style.bottom = '0';
        } else {
            footerContainer.style.bottom = '-50px'; // Adjust this value to control the final position
        }
    });
</script>
