var options = {
    root: null,
    rootMargin: '0px',
    threshold: 0
};

var observer = new IntersectionObserver(function(entries) {
	// isIntersecting is true when element and viewport are overlapping
	// isIntersecting is false when element and viewport don't overlap
    console.log('IntersectionObserver', entries.length);

    entries.forEach(function(entry) {
        var elem = entry.target;

        if(entry.isIntersecting === true){
            entries.forEach(function (entry) {
                elem.classList.add('appearing');
                window.setTimeout(function() {
                    elem.classList.remove('init');
                    elem.classList.remove('appearing');
                }, 1000);
            });
        }
    });
}, options);

var articles = document.querySelectorAll('.listing-item');

articles.forEach(function (elem) {
elem.classList.add('init');
    observer.observe(elem);
});