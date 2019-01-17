var oPage = {
    searchSidebar: function() {
        let needle = $('#sidebarSearch')[0].value;

        let sidebarItems = $('#side-menu')[0].getElementsByTagName('a');
        let hiddenSideLists = $('.nav-second-level');

        //Make all sidebar items visual
        for (i = 0; i < hiddenSideLists.length; i++) {
            hiddenSideLists[i].style.display = 'block';
        }
        for (i = 0; i < sidebarItems.length; i++) {
            if (sidebarItems[i].innerText.toLowerCase().includes(needle.toLowerCase())) {
                sidebarItems[i].style.display = 'block';
            } else {
                sidebarItems[i].style.display = 'none';
            }
        }
    }
}