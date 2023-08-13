// Clickable blocks
var dataAttributeName = 'data-destination';

function setClickableBlocks() {
    document.querySelectorAll('[' + dataAttributeName + ']').forEach((listItem) => {
        listItem.style.cursor = 'pointer';
        listItem.addEventListener('click', handleClickableBlock);
    });
}

function handleClickableBlock(e) {
    const location = this.getAttribute(dataAttributeName);

    if (location) {
        e.preventDefault();
        document.location = location;
        return false;
    }
}

setClickableBlocks();

// Navigation

function enhanceNavigation () {
    function close() {
        if (this.classList.contains('active')) {
            this.blur();
        }
    }

    document.querySelectorAll('.icon-group svg').forEach((icon) => {
        icon.addEventListener('focus', function(e) {
            window.setTimeout(() => icon.classList.add('active'), 400);
        });

        icon.addEventListener('blur', function(e) {
            icon.classList.remove('active');
        });

        icon.addEventListener('click', close);
    });
}

enhanceNavigation();

// Article animation
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

// Video

var videos = document.querySelectorAll('a[href^="https://www.youtube.com/watch?v="]');

for (var video of videos) {
    var id = new URL(video.href).searchParams.get('v');
    video.setAttribute('data-youtube', id);
    video.classList.add('init');
    video.setAttribute('role', 'button');

    video.innerHTML = `<div class="yt-video">
    <div class="play-icon" style="background-image: url(https://img.youtube.com/vi/${id}/0.jpg)">▶</div>
    <div class="title">${video.textContent}</div>
    </div>`;
}

function clickHandler (event) {
    var link = event.target.closest('[data-youtube]');

    if (!link) {
        return;
    }

    event.preventDefault();
    var id = link.getAttribute('data-youtube');

    var player = document.createElement('div');
    player.innerHTML = `<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/${id}?autoplay=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;

    link.replaceWith(player);
}

document.addEventListener('click', clickHandler);

// External Links

document.querySelectorAll('a').forEach(function (anchor) {
    var home = document.location.protocol + '//' + document.location.hostname + '/';
    var isInternal = anchor.href.startsWith(home) || anchor.href.startsWith('/');
    
    if (!isInternal) {
        anchor.setAttribute('target', '_blank');
    }
});