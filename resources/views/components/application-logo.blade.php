<div class="demo-block">
    <a href="#" class="logo-minimal">
        <div class="icon-wrap-minimal">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"
                stroke-linecap="round" stroke-linejoin="round">
                <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                <polyline points="9 22 9 12 15 12 15 22" />
            </svg>
        </div>
        <div class="wordmark-minimal">Easy<span>Coloc</span></div>
    </a>
</div>

<style>
    .logo-minimal {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
    }

    .icon-wrap-minimal {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #5238e8;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        flex-shrink: 0;
        overflow: hidden;
        transition: border-radius .3s ease, transform .3s ease;
    }

    .logo-minimal:hover .icon-wrap-minimal {
        border-radius: 50%;
        transform: scale(1.1);
    }

    .icon-wrap-minimal::before {
        content: '';
        position: absolute;
        top: -6px;
        left: -6px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .15);
    }

    .wordmark-minimal {
        font-family: 'Syne', sans-serif;
        font-weight: 900;
        font-size: 19px;
        letter-spacing: -0.04em;
        color: #1a1625;
        line-height: 1;
    }

    .wordmark-minimal span {
        color: #5238e8;
    }

    svg {
        position: relative;
        z-index: 1;
    }
</style>
