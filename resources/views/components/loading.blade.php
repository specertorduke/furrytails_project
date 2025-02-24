<div id="loading-screen" class="tw-fixed tw-top-0 tw-right-0 tw-bottom-0 tw-transition-all tw-duration-300 tw-bg-white tw-bg-opacity-90 tw-z-50 tw-hidden tw-flex tw-items-center tw-justify-center"
style="left: var(--sidebar-width, 16rem);">
    <div class="tw-flex tw-flex-col tw-items-center">
        <!-- Bouncing Dog Animation -->
        <div class="tw-relative tw-w-24 tw-h-24">
            <div class="tw-absolute tw-w-16 tw-h-16 tw-bg-[#24CFF4] tw-rounded-full tw-top-0 tw-left-4 tw-animate-bounce">
                <!-- Dog Face -->
                <div class="tw-relative">
                    <!-- Eyes -->
                    <div class="tw-absolute tw-w-2 tw-h-2 tw-bg-white tw-rounded-full tw-left-3 tw-top-6"></div>
                    <div class="tw-absolute tw-w-2 tw-h-2 tw-bg-white tw-rounded-full tw-right-3 tw-top-6"></div>
                    <!-- Nose -->
                    <div class="tw-absolute tw-w-3 tw-h-3 tw-bg-black tw-rounded-full tw-left-1/2 tw-top-8 tw--translate-x-1/2"></div>
                    <!-- Ears -->
                    <div class="tw-absolute tw-w-4 tw-h-4 tw-bg-[#24CFF4] tw-rounded-full tw--left-1 tw-top-0 tw-transform -tw-rotate-45"></div>
                    <div class="tw-absolute tw-w-4 tw-h-4 tw-bg-[#24CFF4] tw-rounded-full tw--right-1 tw-top-0 tw-transform tw-rotate-45"></div>
                </div>
            </div>
            <!-- Shadow -->
            <div class="tw-absolute tw-bottom-0 tw-left-1/2 tw--translate-x-1/2 tw-w-12 tw-h-2 tw-bg-gray-200 tw-rounded-full tw-animate-shadow"></div>
        </div>
        <p class="tw-mt-4 tw-text-gray-600 tw-animate-pulse">Loading...</p>
    </div>
</div>

<script>
// Add this script to update the loading screen position
function updateLoadingScreenPosition() {
    const sidebar = document.getElementById('sidebar');
    const loadingScreen = document.getElementById('loading-screen');
    
    if (sidebar.classList.contains('collapsed')) {
        loadingScreen.style.setProperty('--sidebar-width', '4rem'); // 64px
    } else if (sidebar.classList.contains('show')) {
        loadingScreen.style.setProperty('--sidebar-width', '16rem'); // 256px
    } else if (window.innerWidth < 769) {
        loadingScreen.style.setProperty('--sidebar-width', '0');
    } else {
        loadingScreen.style.setProperty('--sidebar-width', '16rem'); // Default width
    }
}

// Add event listeners
document.addEventListener('DOMContentLoaded', updateLoadingScreenPosition);
window.addEventListener('resize', updateLoadingScreenPosition);

// Update loading screen position when sidebar state changes
const observer = new MutationObserver(updateLoadingScreenPosition);
observer.observe(document.getElementById('sidebar'), {
    attributes: true,
    attributeFilter: ['class']
});
</script>