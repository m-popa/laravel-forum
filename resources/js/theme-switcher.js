(() => {
    const media = window.matchMedia('(prefers-color-scheme: dark)');

    function setDark() {
        document.documentElement.classList.add('dark');
    }

    function setLight() {
        document.documentElement.classList.remove('dark');
    }

    function updateTheme(appearance) {
        if (appearance === 'system') {
            if (media.matches) {
                setDark();
            } else {
                setLight();
            }
        } else if (appearance === 'dark') {
            setDark();
        } else if (appearance === 'light') {
            setLight();
        }
    }

    function setButtons(activeAppearance) {
        document.querySelectorAll('button[onclick^="setAppearance"]').forEach((button) => {
            button.setAttribute('aria-pressed', String(button.getAttribute('onclick').includes(activeAppearance)));
        });
    }

    function updateDisplayTheme(appearance) {
        const displayElement = document.getElementById('current-theme');
        if (!displayElement) return;
        if (appearance === 'system') {
            const systemTheme = media.matches ? 'Dark' : 'Light';
            displayElement.textContent = `System (${systemTheme})`;
        } else {
            displayElement.textContent = appearance.charAt(0).toUpperCase() + appearance.slice(1);
        }
    }

    window.setAppearance = function (appearance) {
        if (appearance === 'system') {
            localStorage.removeItem('appearance');
            updateTheme('system');
            media.addEventListener('change', handleSystemChange);
        } else {
            localStorage.setItem('appearance', appearance);
            updateTheme(appearance);
            media.removeEventListener('change', handleSystemChange);
        }
        updateDisplayTheme(appearance);
        if (document.readyState === 'complete') {
            setButtons(appearance);
        } else {
            document.addEventListener("DOMContentLoaded", () => setButtons(appearance));
        }
    };

    function handleSystemChange(e) {
        if (!localStorage.getItem('appearance')) {
            updateTheme('system');
            updateDisplayTheme('system');
        }
    }

    const saved = localStorage.getItem('appearance') || 'system';
    window.setAppearance(saved);
})();
