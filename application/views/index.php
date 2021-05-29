<style>
.basePanel {
    height: 80vh;
    background: rgba(255, 255, 255, 0.6);
    border-radius: 10px;
}

.flex {
    display: flex;
    align-content: center;
    justify-content: space-evenly;
    flex-wrap: wrap;
    flex-direction: column;
    align-items: center;
    height: inherit;
}

img{
    cursor: pointer;
    outline: none;
}

img:hover{
    opacity: 0.7;
}

img:active{
    transform: translateY(4px);
}
</style>

<div class="wrapper wrapper-content">
    <div class="container">
        <div class="basePanel">
            <div class="flex">
                <a  href="<?php echo base_url('MainMenu') ?>">
                    <img src="<?php echo base_url("assets/img/checklist.jpg") ?>" width="100" height="100">
                </a>
            </div>
        </div>
    </div>
</div>