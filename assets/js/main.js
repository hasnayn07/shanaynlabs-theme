(function () {
    'use strict';

    var menuToggle = document.querySelector('[data-menu-toggle]');
    var siteNav = document.querySelector('[data-site-nav]');
    var siteHeader = document.querySelector('.site-header');

    if (siteHeader) {
        var updateHeaderState = function () {
            siteHeader.classList.toggle('is-scrolled', window.scrollY > 12);
        };

        updateHeaderState();
        window.addEventListener('scroll', updateHeaderState, { passive: true });
    }

    if (menuToggle && siteNav) {
        menuToggle.addEventListener('click', function () {
            var isOpen = siteNav.classList.toggle('is-open');

            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            menuToggle.setAttribute('aria-label', isOpen ? 'Close menu' : 'Open menu');
            document.body.classList.toggle('menu-is-open', isOpen);
        });

        siteNav.addEventListener('click', function (event) {
            if (event.target && event.target.closest('a')) {
                siteNav.classList.remove('is-open');
                menuToggle.setAttribute('aria-expanded', 'false');
                menuToggle.setAttribute('aria-label', 'Open menu');
                document.body.classList.remove('menu-is-open');
            }
        });
    }

    var smoothScrollMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
    var normalizePath = function (path) {
        return path.replace(/\/$/, '') || '/';
    };

    document.addEventListener('click', function (event) {
        var anchor = event.target && event.target.closest('a[href*="#"]');

        if (!anchor) {
            return;
        }

        var rawHref = anchor.getAttribute('href');

        if (!rawHref || rawHref === '#') {
            return;
        }

        var targetUrl;

        try {
            targetUrl = new URL(rawHref, window.location.href);
        } catch (error) {
            return;
        }

        if (
            targetUrl.origin !== window.location.origin ||
            normalizePath(targetUrl.pathname) !== normalizePath(window.location.pathname) ||
            !targetUrl.hash
        ) {
            return;
        }

        var targetId;

        try {
            targetId = decodeURIComponent(targetUrl.hash.slice(1));
        } catch (error) {
            return;
        }

        var target = targetId ? document.getElementById(targetId) : null;

        if (!target) {
            return;
        }

        event.preventDefault();

        if (siteNav && siteNav.classList.contains('is-open')) {
            siteNav.classList.remove('is-open');
            document.body.classList.remove('menu-is-open');
        }

        if (menuToggle) {
            menuToggle.setAttribute('aria-expanded', 'false');
            menuToggle.setAttribute('aria-label', 'Open menu');
        }

        var headerHeight = siteHeader ? siteHeader.getBoundingClientRect().height : 80;
        var targetTop = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 16;

        window.scrollTo({
            top: Math.max(targetTop, 0),
            behavior: smoothScrollMotionQuery.matches ? 'auto' : 'smooth'
        });

        if (window.history && window.history.pushState) {
            window.history.pushState(null, '', targetUrl.hash);
        }
    });

    if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.documentElement.classList.add('has-scroll-animations');

        var animatedItems = document.querySelectorAll('[data-animate]');
        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.16 });

        animatedItems.forEach(function (item) {
            observer.observe(item);
        });
    }

    var digitalPresenceSection = document.querySelector('.digital-presence-section');

    if (digitalPresenceSection) {
        var digitalPresencePills = digitalPresenceSection.querySelectorAll('[data-highlight]');
        var clearDigitalPresenceHighlight = function () {
            digitalPresenceSection.removeAttribute('data-active-highlight');
            digitalPresencePills.forEach(function (pill) {
                pill.classList.remove('is-active');
            });
        };
        var setDigitalPresenceHighlight = function (pill) {
            var highlight = pill.getAttribute('data-highlight');

            if (!highlight) {
                return;
            }

            clearDigitalPresenceHighlight();
            digitalPresenceSection.setAttribute('data-active-highlight', highlight);
            pill.classList.add('is-active');
        };

        digitalPresencePills.forEach(function (pill) {
            pill.addEventListener('mouseenter', function () {
                setDigitalPresenceHighlight(pill);
            });

            pill.addEventListener('focus', function () {
                setDigitalPresenceHighlight(pill);
            });

            pill.addEventListener('mouseleave', clearDigitalPresenceHighlight);
            pill.addEventListener('blur', clearDigitalPresenceHighlight);
        });
    }

    var growthEngineSection = document.querySelector('.growth-engine-section');

    if (growthEngineSection) {
        var growthEnginePills = growthEngineSection.querySelectorAll('[data-growth-highlight]');
        var clearGrowthEngineHighlight = function () {
            growthEngineSection.removeAttribute('data-active-highlight');
            growthEnginePills.forEach(function (pill) {
                pill.classList.remove('is-active');
            });
        };
        var setGrowthEngineHighlight = function (pill) {
            var highlight = pill.getAttribute('data-growth-highlight');

            if (!highlight) {
                return;
            }

            clearGrowthEngineHighlight();
            growthEngineSection.setAttribute('data-active-highlight', highlight);
            pill.classList.add('is-active');
        };

        growthEnginePills.forEach(function (pill) {
            pill.addEventListener('mouseenter', function () {
                setGrowthEngineHighlight(pill);
            });

            pill.addEventListener('focus', function () {
                setGrowthEngineHighlight(pill);
            });

            pill.addEventListener('mouseleave', clearGrowthEngineHighlight);
            pill.addEventListener('blur', clearGrowthEngineHighlight);
        });
    }

    var softwareIntelligenceSection = document.querySelector('.software-intelligence-section');

    if (softwareIntelligenceSection) {
        var softwareIntelligencePills = softwareIntelligenceSection.querySelectorAll('[data-software-highlight]');
        var clearSoftwareIntelligenceHighlight = function () {
            softwareIntelligenceSection.removeAttribute('data-active-highlight');
            softwareIntelligencePills.forEach(function (pill) {
                pill.classList.remove('is-active');
            });
        };
        var setSoftwareIntelligenceHighlight = function (pill) {
            var highlight = pill.getAttribute('data-software-highlight');

            if (!highlight) {
                return;
            }

            clearSoftwareIntelligenceHighlight();
            softwareIntelligenceSection.setAttribute('data-active-highlight', highlight);
            pill.classList.add('is-active');
        };

        softwareIntelligencePills.forEach(function (pill) {
            pill.addEventListener('mouseenter', function () {
                setSoftwareIntelligenceHighlight(pill);
            });

            pill.addEventListener('focus', function () {
                setSoftwareIntelligenceHighlight(pill);
            });

            pill.addEventListener('mouseleave', clearSoftwareIntelligenceHighlight);
            pill.addEventListener('blur', clearSoftwareIntelligenceHighlight);
        });
    }

    var industriesSlider = document.querySelector('[data-industries-slider]');

    if (industriesSlider) {
        var industriesViewport = industriesSlider.querySelector('[data-industries-viewport]');
        var industriesPrev = industriesSlider.querySelector('[data-industries-prev]');
        var industriesNext = industriesSlider.querySelector('[data-industries-next]');
        var reduceMotionQuery = window.matchMedia('(prefers-reduced-motion: reduce)');
        var autoSlideDelay = 4000;
        var autoSlideTimer = null;

        if (industriesViewport && industriesPrev && industriesNext) {
            var getCardWidth = function () {
                var firstCard = industriesViewport.querySelector('.industry-slide-card');

                if (!firstCard) {
                    return 0;
                }

                return firstCard.getBoundingClientRect().width + 20;
            };

            var canSlide = function () {
                return industriesViewport.scrollWidth > industriesViewport.clientWidth + 8;
            };

            var goToNext = function () {
                var amount = getCardWidth();

                if (!amount) {
                    return;
                }

                if (industriesViewport.scrollLeft + industriesViewport.clientWidth >= industriesViewport.scrollWidth - 8) {
                    industriesViewport.scrollTo({
                        left: 0,
                        behavior: reduceMotionQuery.matches ? 'auto' : 'smooth'
                    });

                    return;
                }

                industriesViewport.scrollBy({
                    left: amount,
                    behavior: reduceMotionQuery.matches ? 'auto' : 'smooth'
                });
            };

            var goToPrevious = function () {
                var amount = getCardWidth();

                if (!amount) {
                    return;
                }

                if (industriesViewport.scrollLeft <= 8) {
                    industriesViewport.scrollTo({
                        left: industriesViewport.scrollWidth,
                        behavior: reduceMotionQuery.matches ? 'auto' : 'smooth'
                    });

                    return;
                }

                industriesViewport.scrollBy({
                    left: amount * -1,
                    behavior: reduceMotionQuery.matches ? 'auto' : 'smooth'
                });
            };

            var stopAutoSlide = function () {
                if (autoSlideTimer) {
                    window.clearInterval(autoSlideTimer);
                    autoSlideTimer = null;
                }
            };

            var startAutoSlide = function () {
                stopAutoSlide();

                if (reduceMotionQuery.matches || !canSlide()) {
                    return;
                }

                autoSlideTimer = window.setInterval(goToNext, autoSlideDelay);
            };

            industriesNext.addEventListener('click', function () {
                goToNext();
                startAutoSlide();
            });

            industriesPrev.addEventListener('click', function () {
                goToPrevious();
                startAutoSlide();
            });

            industriesSlider.addEventListener('mouseenter', stopAutoSlide);
            industriesSlider.addEventListener('mouseleave', startAutoSlide);
            industriesSlider.addEventListener('focusin', stopAutoSlide);
            industriesSlider.addEventListener('focusout', function (event) {
                if (!industriesSlider.contains(event.relatedTarget)) {
                    startAutoSlide();
                }
            });

            window.addEventListener('resize', startAutoSlide);

            if (typeof reduceMotionQuery.addEventListener === 'function') {
                reduceMotionQuery.addEventListener('change', startAutoSlide);
            } else if (typeof reduceMotionQuery.addListener === 'function') {
                reduceMotionQuery.addListener(startAutoSlide);
            }

            startAutoSlide();
        }
    }

    var digitalPresenceBuildSection = document.querySelector('.dp-build-section');

    if (digitalPresenceBuildSection) {
        var buildTabs = digitalPresenceBuildSection.querySelectorAll('[data-build-preview]');
        var buildPanels = digitalPresenceBuildSection.querySelectorAll('.dp-build-preview-panel');

        if (buildTabs.length && buildPanels.length) {
            var activateBuildPreview = function (target) {
                buildTabs.forEach(function (tab) {
                    var isActive = tab.getAttribute('data-build-preview') === target;

                    tab.classList.toggle('is-active', isActive);
                    tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    tab.setAttribute('tabindex', isActive ? '0' : '-1');
                });

                buildPanels.forEach(function (panel) {
                    var isActive = panel.id === 'dp-build-panel-' + target;

                    panel.classList.toggle('is-active', isActive);

                    if (isActive) {
                        panel.removeAttribute('hidden');
                    } else {
                        panel.setAttribute('hidden', 'hidden');
                    }
                });
            };

            buildTabs.forEach(function (tab, index) {
                var target = tab.getAttribute('data-build-preview');

                tab.addEventListener('mouseenter', function () {
                    activateBuildPreview(target);
                });

                tab.addEventListener('focus', function () {
                    activateBuildPreview(target);
                });

                tab.addEventListener('click', function () {
                    activateBuildPreview(target);
                });

                tab.addEventListener('keydown', function (event) {
                    var key = event.key;
                    var nextIndex = index;

                    if (key === 'ArrowDown' || key === 'ArrowRight') {
                        nextIndex = (index + 1) % buildTabs.length;
                    } else if (key === 'ArrowUp' || key === 'ArrowLeft') {
                        nextIndex = (index - 1 + buildTabs.length) % buildTabs.length;
                    } else if (key === 'Home') {
                        nextIndex = 0;
                    } else if (key === 'End') {
                        nextIndex = buildTabs.length - 1;
                    } else {
                        return;
                    }

                    event.preventDefault();
                    buildTabs[nextIndex].focus();
                    activateBuildPreview(buildTabs[nextIndex].getAttribute('data-build-preview'));
                });
            });
        }
    }

    var growthEngineBuildSection = document.querySelector('.ge-build');

    if (growthEngineBuildSection) {
        var growthBuildTabs = growthEngineBuildSection.querySelectorAll('[data-growth-service]');
        var growthBuildPanels = growthEngineBuildSection.querySelectorAll('.ge-build-preview');

        if (growthBuildTabs.length && growthBuildPanels.length) {
            var activateGrowthBuildPreview = function (target) {
                growthBuildTabs.forEach(function (tab) {
                    var isActive = tab.getAttribute('data-growth-service') === target;

                    tab.classList.toggle('is-active', isActive);
                    tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    tab.setAttribute('tabindex', isActive ? '0' : '-1');
                });

                growthBuildPanels.forEach(function (panel) {
                    var isActive = panel.id === 'ge-preview-' + target;

                    panel.classList.toggle('is-active', isActive);

                    if (isActive) {
                        panel.removeAttribute('hidden');
                    } else {
                        panel.setAttribute('hidden', 'hidden');
                    }
                });
            };

            growthBuildTabs.forEach(function (tab, index) {
                var target = tab.getAttribute('data-growth-service');

                tab.addEventListener('click', function () {
                    activateGrowthBuildPreview(target);
                });

                tab.addEventListener('focus', function () {
                    activateGrowthBuildPreview(target);
                });

                tab.addEventListener('keydown', function (event) {
                    var key = event.key;
                    var nextIndex = index;

                    if (key === 'ArrowDown' || key === 'ArrowRight') {
                        nextIndex = (index + 1) % growthBuildTabs.length;
                    } else if (key === 'ArrowUp' || key === 'ArrowLeft') {
                        nextIndex = (index - 1 + growthBuildTabs.length) % growthBuildTabs.length;
                    } else if (key === 'Home') {
                        nextIndex = 0;
                    } else if (key === 'End') {
                        nextIndex = growthBuildTabs.length - 1;
                    } else {
                        return;
                    }

                    event.preventDefault();
                    growthBuildTabs[nextIndex].focus();
                    activateGrowthBuildPreview(growthBuildTabs[nextIndex].getAttribute('data-growth-service'));
                });
            });
        }
    }

    var softwareBuildSection = document.querySelector('.si-build');

    if (softwareBuildSection) {
        var softwareBuildTabs = softwareBuildSection.querySelectorAll('[data-software-service]');
        var softwareBuildPanels = softwareBuildSection.querySelectorAll('.si-build-preview');

        if (softwareBuildTabs.length && softwareBuildPanels.length) {
            var activateSoftwareBuildPreview = function (target) {
                softwareBuildTabs.forEach(function (tab) {
                    var isActive = tab.getAttribute('data-software-service') === target;

                    tab.classList.toggle('is-active', isActive);
                    tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    tab.setAttribute('tabindex', isActive ? '0' : '-1');
                });

                softwareBuildPanels.forEach(function (panel) {
                    var isActive = panel.id === 'si-preview-' + target;

                    panel.classList.toggle('is-active', isActive);

                    if (isActive) {
                        panel.removeAttribute('hidden');
                    } else {
                        panel.setAttribute('hidden', 'hidden');
                    }
                });
            };

            softwareBuildTabs.forEach(function (tab, index) {
                var target = tab.getAttribute('data-software-service');

                tab.addEventListener('click', function () {
                    activateSoftwareBuildPreview(target);
                });

                tab.addEventListener('focus', function () {
                    activateSoftwareBuildPreview(target);
                });

                tab.addEventListener('keydown', function (event) {
                    var key = event.key;
                    var nextIndex = index;

                    if (key === 'ArrowDown' || key === 'ArrowRight') {
                        nextIndex = (index + 1) % softwareBuildTabs.length;
                    } else if (key === 'ArrowUp' || key === 'ArrowLeft') {
                        nextIndex = (index - 1 + softwareBuildTabs.length) % softwareBuildTabs.length;
                    } else if (key === 'Home') {
                        nextIndex = 0;
                    } else if (key === 'End') {
                        nextIndex = softwareBuildTabs.length - 1;
                    } else {
                        return;
                    }

                    event.preventDefault();
                    softwareBuildTabs[nextIndex].focus();
                    activateSoftwareBuildPreview(softwareBuildTabs[nextIndex].getAttribute('data-software-service'));
                });
            });
        }
    }

    var productsShowcase = document.querySelector('[data-products-showcase]');

    if (productsShowcase) {
        var productTabs = productsShowcase.querySelectorAll('[data-product-target]');
        var productPanels = productsShowcase.querySelectorAll('.product-preview-panel');
        var prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (productTabs.length && productPanels.length) {
            var activateProductPanel = function (targetId) {
                productTabs.forEach(function (tab) {
                    var isActive = tab.getAttribute('data-product-target') === targetId;

                    tab.classList.toggle('is-active', isActive);
                    tab.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    tab.setAttribute('tabindex', isActive ? '0' : '-1');
                });

                productPanels.forEach(function (panel) {
                    var isActive = panel.id === targetId;

                    panel.classList.toggle('is-active', isActive);

                    if (isActive) {
                        panel.removeAttribute('hidden');
                    } else {
                        panel.setAttribute('hidden', 'hidden');
                    }
                });
            };

            productTabs.forEach(function (tab, index) {
                tab.addEventListener('click', function () {
                    activateProductPanel(tab.getAttribute('data-product-target'));
                });

                tab.addEventListener('keydown', function (event) {
                    var key = event.key;
                    var nextIndex = index;

                    if (key === 'ArrowDown' || key === 'ArrowRight') {
                        nextIndex = (index + 1) % productTabs.length;
                    } else if (key === 'ArrowUp' || key === 'ArrowLeft') {
                        nextIndex = (index - 1 + productTabs.length) % productTabs.length;
                    } else {
                        return;
                    }

                    event.preventDefault();
                    productTabs[nextIndex].focus();
                    activateProductPanel(productTabs[nextIndex].getAttribute('data-product-target'));
                });
            });

            if (prefersReducedMotion) {
                productPanels.forEach(function (panel) {
                    panel.style.scrollBehavior = 'auto';
                });
            }
        }
    }

    var workBrowser = document.querySelector('[data-work-browser]');

    if (workBrowser) {
        var workButtons = workBrowser.querySelectorAll('[data-work-pillar]');
        var workPanels = workBrowser.querySelectorAll('[data-work-panel]');
        var workStates = workBrowser.querySelectorAll('[data-work-state]');
        var workReduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        if (workButtons.length && workPanels.length) {
            var activateWorkPillar = function (target) {
                workButtons.forEach(function (button) {
                    var isActive = button.getAttribute('data-work-pillar') === target;

                    button.classList.toggle('is-active', isActive);
                    button.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    button.setAttribute('tabindex', isActive ? '0' : '-1');
                });

                if (workStates.length) {
                    workStates.forEach(function (state) {
                        var isActive = state.getAttribute('data-work-state') === target;

                        state.classList.toggle('is-active', isActive);

                        if (isActive) {
                            state.removeAttribute('hidden');
                        } else {
                            state.setAttribute('hidden', 'hidden');
                        }
                    });
                }

                workPanels.forEach(function (panel) {
                    var isActive = panel.getAttribute('data-work-panel') === target;

                    panel.classList.toggle('is-active', isActive);

                    if (isActive) {
                        panel.removeAttribute('hidden');

                        if (!workReduceMotion) {
                            panel.classList.remove('is-entering');
                            window.requestAnimationFrame(function () {
                                panel.classList.add('is-entering');
                            });
                        }
                    } else {
                        panel.setAttribute('hidden', 'hidden');
                        panel.classList.remove('is-entering');
                    }
                });
            };

            workButtons.forEach(function (button, index) {
                button.addEventListener('click', function () {
                    activateWorkPillar(button.getAttribute('data-work-pillar'));
                });

                button.addEventListener('keydown', function (event) {
                    var key = event.key;
                    var nextIndex = index;

                    if (key === 'ArrowRight' || key === 'ArrowDown') {
                        nextIndex = (index + 1) % workButtons.length;
                    } else if (key === 'ArrowLeft' || key === 'ArrowUp') {
                        nextIndex = (index - 1 + workButtons.length) % workButtons.length;
                    } else if (key === 'Home') {
                        nextIndex = 0;
                    } else if (key === 'End') {
                        nextIndex = workButtons.length - 1;
                    } else {
                        return;
                    }

                    event.preventDefault();
                    workButtons[nextIndex].focus();
                    activateWorkPillar(workButtons[nextIndex].getAttribute('data-work-pillar'));
                });
            });

            activateWorkPillar('digital-presence');
        }
    }

    var productExplorer = document.querySelector('[data-product-explorer]');

    if (productExplorer) {
        var productFilterButtons = productExplorer.querySelectorAll('[data-product-filter]');
        var productGrid = productExplorer.querySelector('[data-product-grid]');
        var productCards = productExplorer.querySelectorAll('[data-product-card]');
        var productLoadMore = productExplorer.querySelector('[data-product-load-more]');
        var productLoadMoreWrap = productExplorer.querySelector('[data-product-load-more-wrap]');
        var productDefaultLimit = 6;
        var currentProductFilter = 'all';
        var productShowingAll = false;

        if (productFilterButtons.length && productGrid && productCards.length) {
            var getVisibleProductCards = function () {
                return Array.prototype.filter.call(productCards, function (card) {
                    return !card.hasAttribute('hidden');
                });
            };

            var updateProductGridState = function () {
                var visibleProductCards = getVisibleProductCards();
                var visibleCount = visibleProductCards.length;

                productGrid.setAttribute('data-visible-count', String(visibleCount));

                if (!productLoadMore) {
                    return;
                }

                if (visibleCount > productDefaultLimit && !productShowingAll) {
                    productLoadMore.removeAttribute('hidden');
                    if (productLoadMoreWrap) {
                        productLoadMoreWrap.removeAttribute('hidden');
                    }
                } else {
                    productLoadMore.setAttribute('hidden', 'hidden');
                    if (productLoadMoreWrap) {
                        productLoadMoreWrap.setAttribute('hidden', 'hidden');
                    }
                }
            };

            var applyProductVisibility = function () {
                var matchedCards = [];

                Array.prototype.forEach.call(productCards, function (card) {
                    var cardCategories = (card.getAttribute('data-product-category') || '').split(/\s+/).filter(Boolean);
                    var isMatch = 'all' === currentProductFilter || cardCategories.indexOf(currentProductFilter) !== -1;

                    if (isMatch) {
                        matchedCards.push(card);
                    }

                    card.setAttribute('hidden', 'hidden');
                    card.setAttribute('data-product-hidden', 'hidden');
                });

                matchedCards.forEach(function (card, index) {
                    var shouldShow = productShowingAll || index < productDefaultLimit;

                    if (shouldShow) {
                        card.removeAttribute('hidden');
                        card.removeAttribute('data-product-hidden');
                    }
                });

                updateProductGridState();
            };

            var activateProductFilter = function (target) {
                currentProductFilter = target;
                productShowingAll = false;

                Array.prototype.forEach.call(productFilterButtons, function (button) {
                    var isActive = button.getAttribute('data-product-filter') === target;

                    button.classList.toggle('is-active', isActive);
                    button.setAttribute('aria-selected', isActive ? 'true' : 'false');
                    button.setAttribute('tabindex', isActive ? '0' : '-1');
                });

                applyProductVisibility();
            };

            Array.prototype.forEach.call(productFilterButtons, function (button, index) {
                button.addEventListener('click', function () {
                    activateProductFilter(button.getAttribute('data-product-filter'));
                });

                button.addEventListener('keydown', function (event) {
                    var key = event.key;
                    var nextIndex = index;

                    if (key === 'ArrowRight' || key === 'ArrowDown') {
                        nextIndex = (index + 1) % productFilterButtons.length;
                    } else if (key === 'ArrowLeft' || key === 'ArrowUp') {
                        nextIndex = (index - 1 + productFilterButtons.length) % productFilterButtons.length;
                    } else if (key === 'Home') {
                        nextIndex = 0;
                    } else if (key === 'End') {
                        nextIndex = productFilterButtons.length - 1;
                    } else {
                        return;
                    }

                    event.preventDefault();
                    productFilterButtons[nextIndex].focus();
                    activateProductFilter(productFilterButtons[nextIndex].getAttribute('data-product-filter'));
                });
            });

            if (productLoadMore) {
                productLoadMore.addEventListener('click', function () {
                    productShowingAll = true;
                    applyProductVisibility();
                });
            }

            activateProductFilter('all');
        }
    }
}());
