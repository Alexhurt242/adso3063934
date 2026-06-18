const get = (id) => document.getElementById(id);

const loginScreen = get('loginScreen');
const registerScreen = get('registerScreen');
const dashboardScreen = get('dashboardScreen');
const frameFiveScreen = get('frameFiveScreen');
const musicScreen = get('musicScreen');
const profileScreen = get('profileScreen');
const settingsScreen = get('settingsScreen');
const addHubScreen = get('addHubScreen');
const addSongScreen = get('addSongScreen');
const addAlbumScreen = get('addAlbumScreen');
const addMemberScreen = get('addMemberScreen');
const mainScreen = get('mainScreen');

const signinBtn = get('signinBtn');
const signupBtn = get('signupBtn');
const backBtn = get('backBtn');
const backRegisterBtn = get('backRegisterBtn');
const signInFormBtn = get('signInFormBtn');
const signUpFormBtn = get('signUpFormBtn');
const loginEmailInput = get('emailInput');
const loginPasswordInput = get('passwordInput');
const registerForm = get('registerForm');
const usernameInput = get('usernameInput');
const registerEmailInput = get('registerEmailInput');
const registerPasswordInput = get('registerPasswordInput');
const registerConfirmInput = get('registerConfirmInput');

const openAddSongBtn = get('openAddSongBtn');
const openAddAlbumBtn = get('openAddAlbumBtn');
const openAddMemberBtn = get('openAddMemberBtn');

const screens = [
    loginScreen,
    registerScreen,
    dashboardScreen,
    frameFiveScreen,
    musicScreen,
    profileScreen,
    settingsScreen,
    addHubScreen,
    addSongScreen,
    addAlbumScreen,
    addMemberScreen,
];

function onClick(element, callback) {
    if (!element) return;
    element.addEventListener('click', callback);
}

function onClickAll(selector, callback) {
    document.querySelectorAll(selector).forEach((element) => onClick(element, callback));
}

function hideAllScreens() {
    screens.forEach((screen) => {
        if (screen) screen.style.display = 'none';
    });

    if (mainScreen) mainScreen.style.display = 'none';
}

function showMainScreen() {
    hideAllScreens();
    if (mainScreen) mainScreen.style.display = 'flex';
}

function showAppScreen(screen) {
    hideAllScreens();
    if (screen) screen.style.display = 'flex';
}

function clearLoginForm() {
    if (loginEmailInput) loginEmailInput.value = '';
    if (loginPasswordInput) loginPasswordInput.value = '';
}

function clearRegisterForm() {
    if (usernameInput) usernameInput.value = '';
    if (registerEmailInput) registerEmailInput.value = '';
    if (registerPasswordInput) registerPasswordInput.value = '';
    if (registerConfirmInput) registerConfirmInput.value = '';
}

onClick(signinBtn, () => showAppScreen(loginScreen));
onClick(signupBtn, () => showAppScreen(registerScreen));
onClick(backBtn, showMainScreen);
onClick(backRegisterBtn, showMainScreen);

onClick(signInFormBtn, () => {
    clearLoginForm();
    showAppScreen(dashboardScreen);
});

onClick(signUpFormBtn, () => showAppScreen(registerScreen));

if (registerForm) {
    registerForm.addEventListener('submit', (event) => {
        event.preventDefault();
        clearRegisterForm();
        showAppScreen(dashboardScreen);
    });
}

onClickAll('.js-main-nav', showMainScreen);
onClickAll('.js-settings-nav, #dashboardMenuBtn, #frameMenuBtn', () => showAppScreen(settingsScreen));
onClickAll('.js-music-nav, #frameMusicBtn, #dashboardMusicBtn', () => showAppScreen(musicScreen));
onClickAll('.js-story-nav, #openFrameFiveBtn, #frameCurrentBtn', () => showAppScreen(frameFiveScreen));
onClickAll('.js-home-nav, #frameDashboardNavBtn, #dashboardHomeBtn', () => showAppScreen(dashboardScreen));
onClickAll('.js-add-nav, #framePlusBtn, #dashboardAddBtn', () => showAppScreen(addHubScreen));
onClickAll('.js-profile-nav, #frameProfileBtn, #dashboardProfileBtn', () => showAppScreen(profileScreen));

onClick(openAddSongBtn, () => showAppScreen(addSongScreen));
onClick(openAddAlbumBtn, () => showAppScreen(addAlbumScreen));
onClick(openAddMemberBtn, () => showAppScreen(addMemberScreen));
onClickAll('.add-form button[type="button"]', () => showAppScreen(addHubScreen));

document.querySelectorAll('.artist').forEach((artist) => {
    const button = artist.querySelector('.arrow');
    const info = artist.querySelector('.info');
    const shortInfo = info?.querySelector('.short-info');
    const fullInfo = info?.querySelector('.full-info');
    if (!button || !shortInfo || !fullInfo) return;

    let isExpanded = false;

    button.addEventListener('click', () => {
        isExpanded = !isExpanded;

        if (isExpanded) {
            shortInfo.style.display = 'none';
            fullInfo.style.display = 'block';
            button.innerHTML = '&#8595;';
            artist.classList.add('expanded');
            return;
        }

        shortInfo.style.display = 'block';
        fullInfo.style.display = 'none';
        button.innerHTML = '&#8594;';
        artist.classList.remove('expanded');
    });
});
