import './bootstrap';

const btn = document.getElementById('btn');
btn.addEventListener('click', () => {
    btn.classList.add('big');
    console.log(btn.classList);

    setTimeout(() => {
        btn.classList.remove('big');
    }, 300);
});
