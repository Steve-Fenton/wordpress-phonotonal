var articleOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0
};

var cn = {
    init: 'init',
    appearing: 'appearing'
};

function onArticleIntersection(entries) {
    var delay = 0;
    entries.forEach(function(entry) {
        var elem = entry.target;

        window.setTimeout(function () {
            if (entry.isIntersecting === true) {
                entries.forEach(function () {
                    elem.classList.add(cn.appearing);
                });
            } else {
                elem.classList.remove(cn.appearing);
            }
        }, delay);

        delay += 100;
    });
}

var articles = document.querySelectorAll('.listing-item');
var articleObserver = new IntersectionObserver(onArticleIntersection, articleOptions);

var hasSkippedFirst = false;

articles.forEach(function (elem) {
    elem.classList.add(cn.init);
    articleObserver.observe(elem);
    if (!hasSkippedFirst) {
        elem.classList.add(cn.appearing);
        hasSkippedFirst = true;
    }
});