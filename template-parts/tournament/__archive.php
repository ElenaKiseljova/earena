?>
<div class="<?php if (is_page(521) || $profile == true) {
    echo 'col-lg-6 col-md-6 col-sm-6';
} else {
    echo 'col-lg-4 col-md-4 col-sm-6';
} ?>">
    <!--							<div class="<?php if ($profile == true) {
        echo 'col-lg-6 col-md-6 col-sm-6';
    } else {
        echo 'col-lg-4 col-md-4 col-sm-6';
    } ?>">-->
    <!--							<div class="<?php echo 'col-lg-6 col-md-6 col-sm-6'; ?>">-->
    <div class="item <?= in_array(get_current_user_id(),
        json_decode($tournament->players, true) ?: []) ? 'my-item' : ''; ?>">
        <div class="top-info">
            <div class="left">
                <img src="<?php bloginfo('template_url'); ?>/images/icons/<?= $ea_icons['platform'][(int)$tournament->platform]; ?>.svg"
                     class="svg platform-icon" alt="">
                <img src="<?php bloginfo('template_url'); ?>/images/icons/<?= $ea_icons['game'][(int)$tournament->game]; ?>.svg"
                     class="svg game-icon" alt="">
                <div class="txt">
                    <span><?= $games[$tournament->game]['shortname']; ?></span>
                    <div class="id">ID <?= $tournament->ID; ?></div>
                </div>
            </div>

            <?php if ($tournament->vip): ?>
                <div class="vip">VIP</div>
            <?php endif; ?>

            <div class="right">
                <div class="price"><?= !empty($tournament->price) ? '$'.$tournament->price : 'free'; ?></div>
                <?php if ($tournament->private): ?>
                    <div class="lock right"><img src="<?php bloginfo('template_url'); ?>/images/icons/icon-lock.svg"
                                                 alt=""></div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ((int)$tournament->type == 1): ?>
            <a href="<?= (stripos($_SERVER['REQUEST_URI'],
                    '/profile/tours/') !== false) ? '/profile/tours/tour/?tournament=' . $tournament->ID : '/tournaments/tournament/?tournament=' . $tournament->ID; ?>"
               class="text-tour<?= $tournament->status > 101 ? ' tour-end' : ''; ?>"
               style="background: linear-gradient(180deg, rgba(57, 57, 57, 0) 0%, #000000 100%), url(<?= wp_get_attachment_url($tournament->cover1); ?>) center no-repeat;">
                <?php if ((int)$tournament->status !== 103) { ?>
                    <div class="start-time"><?php _e('Начало', 'earena'); ?> <?= date('d.m.Y',
                            utc_to_usertime(strtotime($tournament->start_time))); ?> <?php _e('в', 'earena'); ?> <?= date('H:i',
                            utc_to_usertime(strtotime($tournament->start_time))); ?> (UTC<?= utc_value(); ?>)
                    </div>
                    <?php if ((int)$tournament->status > 101): ?>
                        <div class="start-time"><?php _e('Завершен', 'earena'); ?> <?= date('d.m.Y',
                                utc_to_usertime(strtotime($tournament->end_time))); ?> <?php _e('в', 'earena'); ?> <?= date('H:i',
                                utc_to_usertime(strtotime($tournament->end_time))); ?> (UTC<?= utc_value(); ?>)
                        </div>
                    <?php endif; ?>
                <?php } ?>

                <div class="texts">
                    <div class="infos">
                        <?php if ($tournament->status < 2): ?>
                            <div class="btn-end button inproc"><?php _e('Ожидает публикации', 'earena'); ?></div>
                        <?php elseif ($tournament->status >= 2 && $tournament->status < 4): ?>
                            <div class="btn-reg button button-purple"><?php _e('Регистрация', 'earena'); ?></div>
                        <?php elseif ($tournament->status >= 4 && $tournament->status <= 101): ?>
                            <div class="btn-now button inproc"><?php _e('Проходит', 'earena'); ?></div>
                        <?php elseif ($tournament->status > 101 && $tournament->status < 103): ?>
                            <div class="btn-end button inproc"><?php _e('Завершен', 'earena'); ?></div>
                        <?php elseif ($tournament->status == 103): ?>
                            <div class="btn-cancel button button-red"><?php _e('Отменен', 'earena'); ?></div>
                        <?php endif; ?>
                        <div class="party button button-white"><img class="svg"
                                                                    src="<?php bloginfo('template_url'); ?>/images/icons/icon-users.svg"
                                                                    alt=""> <?= count(json_decode($tournament->players,
                                true) ?: []); ?>/<?= $tournament->max_players; ?></div>
                        <div class="prize"><img class="svg"
                                                src="<?php bloginfo('template_url'); ?>/images/icons/icon-prize.svg"
                                                alt=""> $<?= max($tournament->prize, $tournament->garant); ?></div>
                    </div>
                    <div class="name"><?= $tournament->name; ?></div>
                </div>
            </a>

        <?php elseif ((int)$tournament->type == 2): ?>
            <a href="<?= (stripos($_SERVER['REQUEST_URI'],
                    '/profile/tours/') !== false) ? '/profile/tours/tour/?tournament=' . $tournament->ID : '/tournaments/lucky-cup/?lc=' . $tournament->ID; ?>"
               class="text-tour<?= $tournament->status > 101 ? ' tour-end' : ''; ?>"
               style="background: linear-gradient(180deg, rgba(57, 57, 57, 0) 0%, #000000 100%), url(<?= wp_get_attachment_url($tournament->cover1); ?>) center no-repeat;">
                <span class="title">LUCKY CUP</span>
                <div class="prize"><img class="svg"
                                        src="<?php bloginfo('template_url'); ?>/images/icons/icon-prize.svg" alt=""><?php _e('до', 'earena'); ?>
                    $<?= $tournament->garant; ?></div>

                <div class="texts">
                    <div class="infos">
                        <?php if ($tournament->status < 4): ?>
                            <div class="btn-reg button button-purple"><?php _e('Регистрация', 'earena'); ?></div>
                        <?php elseif ($tournament->status >= 4 && $tournament->status <= 101): ?>
                            <div class="btn-reg button inproc"><?php _e('Проходит', 'earena'); ?></div>
                        <?php elseif ($tournament->status > 101): ?>
                            <div class="btn-reg button inproc"><?php _e('Завершен', 'earena'); ?></div>
                        <?php endif; ?>
                        <div class="party button button-white"><img class="svg"
                                                                    src="<?php bloginfo('template_url'); ?>/images/icons/icon-users.svg"
                                                                    alt=""> <?= count(json_decode($tournament->players,
                                true) ?: []); ?>/<?= $tournament->max_players; ?></div>
                    </div>
                    <div class="name"><?= $tournament->name; ?></div>
                </div>
            </a>

        <?php elseif ((int)$tournament->type == 3): ?>
            <a href="<?= (stripos($_SERVER['REQUEST_URI'],
                    '/profile/tours/') !== false) ? '/profile/tours/tour/?tournament=' . $tournament->ID : '/tournaments/cup/?cup=' . $tournament->ID; ?>"
               class="text-tour<?= $tournament->status > 101 ? ' tour-end' : ''; ?>"
               style="background: linear-gradient(180deg, rgba(57, 57, 57, 0) 0%, #000000 100%), url(<?= wp_get_attachment_url($tournament->cover1); ?>) center no-repeat;">
                <?php if ((int)$tournament->status !== 103) { ?>
                    <div class="start-time"><?php _e('Начало', 'earena'); ?> <?= date('d.m.Y',
                            utc_to_usertime(strtotime($tournament->start_time))); ?> <?php _e('в', 'earena'); ?> <?= date('H:i',
                            utc_to_usertime(strtotime($tournament->start_time))); ?> (UTC<?= utc_value(); ?>)
                    </div>
                    <?php if ((int)$tournament->status > 101): ?>
                        <div class="start-time"><?php _e('Завершен', 'earena'); ?> <?= date('d.m.Y',
                                utc_to_usertime(strtotime($tournament->end_time))); ?> <?php _e('в', 'earena'); ?> <?= date('H:i',
                                utc_to_usertime(strtotime($tournament->end_time))); ?> (UTC<?= utc_value(); ?>)
                        </div>
                    <?php endif; ?>
                <?php } ?>

                <div class="texts">
                    <div class="infos">
                        <?php if ($tournament->status < 2): ?>
                            <div class="btn-end button inproc"><?php _e('Ожидает публикации', 'earena'); ?></div>
                        <?php elseif ($tournament->status >= 2 && $tournament->status < 4): ?>
                            <div class="btn-reg button button-purple"><?php _e('Регистрация', 'earena'); ?></div>
                        <?php elseif ($tournament->status >= 4 && $tournament->status <= 101): ?>
                            <div class="btn-now button inproc"><?php _e('Проходит', 'earena'); ?></div>
                        <?php elseif ($tournament->status > 101 && $tournament->status < 103): ?>
                            <div class="btn-end button inproc"><?php _e('Завершен', 'earena'); ?></div>
                        <?php elseif ($tournament->status == 103): ?>
                            <div class="btn-cancel button button-red"><?php _e('Отменен', 'earena'); ?></div>
                        <?php endif; ?>
                        <div class="party button button-white"><img class="svg"
                                                                    src="<?php bloginfo('template_url'); ?>/images/icons/icon-users.svg"
                                                                    alt=""> <?= count(json_decode($tournament->players,
                                true) ?: []); ?><?= !empty($tournament->max_players) ? '/' . $tournament->max_players : ''; ?>
                        </div>
                        <div class="prize"><img class="svg"
                                                src="<?php bloginfo('template_url'); ?>/images/icons/icon-prize.svg"
                                                alt=""> $<?= max($tournament->prize, $tournament->garant); ?></div>
                    </div>
                    <div class="name"><?= $tournament->name; ?></div>
                </div>
            </a>

        <?php endif; ?>
        <?php if ($tournament->status > 101 && !empty($tournament->winner)): ?>
            <a href="<?= ea_user_link(json_decode($tournament->winner)[0]); ?>" class="winner">
                <?= bp_core_fetch_avatar('item_id=' . json_decode($tournament->winner)[0]); ?>
                <span>WINNER</span>
            </a>
        <?php endif; ?>

        <div class="bottom-info">
            <div><span><?php _e('Режим игры', 'earena'); ?></span>
                <span><?= game_mode_to_string($tournament->game_mode); ?></span></div>
            <div><span><?php if ($tournament->team_mode > 0) : ?><?php _e('Команда', 'earena'); ?></span>
                <span><?= team_mode_to_string($tournament->team_mode); ?><?php else: ?>&nbsp;<?php endif; ?></span>
            </div>
        </div>
    </div>
</div>
