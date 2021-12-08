<?php
/*
Template Name: Статистика пользователей - Финансы (админ)
*/

//global $wpdb;
$statistics = ea_get_financial_statistics();
if (is_page(6307)) {
    $link = get_page_link(6301);
} elseif (is_page(6304)) {
    $link = get_page_link(6298);
} else {
    $link = get_page_link(577);
}
?>

<?php get_header(); ?>
<script src="<?= get_template_directory_uri(); ?>/assets/libs/vue_v2.6.14.js"></script>

<script src="<?= get_template_directory_uri(); ?>/assets/libs/axios_0.18.0.min.js"></script>

<main class="page-main">
  <!-- СЕО h1 -->
  <h1 class="visually-hidden">
    <?php the_title(  ); ?>
  </h1>

  <div class="page-main__wrapper page-main__wrapper--statistic" id="app_create_tournament">
      <a class="top-for-scroll" href="#top-for-scroll"></a>
      <div id="top-for-scroll">
        <div class="page-main__header page-main__header--statistic">
          <div class="tabs tabs--statistic">
            <a href="<?php echo $link; ?>" :class="{'active':activeTab===1}" class="tabs__button tabs__button--statistic">
              <?php _e('Общая', 'earena'); ?>
            </a>
            <a @click.prevent="activeTab=2"
                :class="{'active':activeTab===2}" class="tabs__button tabs__button--statistic">
              <?php _e('Финансовая', 'earena'); ?>
            </a>
          </div>
        </div>

          <div class="finansist">
              <div><?php _e('Общая прибыль', 'earena'); ?>: <span class="green"><b>$<?= $statistics['profit_total'] ?></b></span>
              </div>
              <div><?php _e('С матчей', 'earena'); ?>: <b>$<?= $statistics['profit_matches'] ?></b></div>
              <div><?php _e('С турниров', 'earena'); ?>: <b>$<?= $statistics['profit_tournaments'] ?></b></div>
              <div><?php _e('VIP-статусы', 'earena'); ?>: <b>$<?= $statistics['profit_vip'] ?></b></div>
              <div><?php _e('Продано VIP', 'earena'); ?>: <b><?= $statistics['quantity_vip'] ?> </b></div>

          </div>
          <div class="form_filter--wrapper" :class="{'stop' : load}">
              <form id="matches-filter" class="filters filters--statistics">
                  <div class="row justify-content-between no-after no-before d-flex id-search-container">
                      <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 id-search">
                          <div class="d-flex nick-search-wrapper">
                              <label for="match-id">
                                  <input @change="id"
                                         @input="id"
                                         id="player"
                                         v-model="formData.id"
                                         type="text"
                                         class="input-search-id"
                                         placeholder="<?php _e('ID', 'earena'); ?>">
                              </label>
                              <div style="cursor: pointer;display: flex;flex-direction: column;justify-content: center;margin-left: -20px;"
                                   @click="clearId" v-if="formData.id !== ''">
                                  <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                      <path d="M9.99996 18.3334C14.6023 18.3334 18.3333 14.6024 18.3333 10C18.3333 5.39765 14.6023 1.66669 9.99996 1.66669C5.39759 1.66669 1.66663 5.39765 1.66663 10C1.66663 14.6024 5.39759 18.3334 9.99996 18.3334Z"
                                            fill="#CACACA"/>
                                      <path d="M12.5 7.5L7.5 12.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                      <path d="M7.5 7.5L12.5 12.5" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"/>
                                  </svg>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 id-search">
                          <div class="row d-flex">
                              <div class="col-lg-6 col-md-6 vertical-center text-right">
                                  <span>{{labels[formData.type]}} <b>{{testCount}}</b></span>
                              </div>
                              <div class="col-lg-6 col-md-6 grow-1">
                                  <div class="select-box"
                                       :class="{'open': ddflag[0]}"
                                       @click="ddflag[0] = true">
                                      <button :aria-expanded="ddflag[0]"
                                              @click.prevent.stop="ddflag[0] = !ddflag[0]"
                                              class="name dropdown-toggle">
                                          {{types[formData.type]}}<span class="arrow"></span>
                                      </button>
                                      <div class="menu-list dropdown-menu">
                                          <label @click.stop="" for="type0" class="box_radio check_tour">
                                              <input @change="changeForm" type="radio" name="type" v-model="formData.type"
                                                     id="type0" value="0">
                                              <span class="checkmark"></span>{{types[0]}}
                                          </label>
                                          <label @click.stop="" for="type1" class="box_radio check_tour">
                                              <input @change="changeForm" type="radio" name="type" v-model="formData.type"
                                                     id="type1" value="1">
                                              <span class="checkmark"></span>{{types[1]}}
                                          </label>
                                          <label @click.stop="" for="type2" class="box_radio check_tour">
                                              <input @change="changeForm" type="radio" name="type" v-model="formData.type"
                                                     id="type2" value="2">
                                              <span class="checkmark"></span>{{types[2]}}
                                          </label>
                                          <label @click.stop="" for="type3" class="box_radio check_tour">
                                              <input @change="changeForm" type="radio" name="type" v-model="formData.type"
                                                     id="type3" value="3">
                                              <span class="checkmark"></span>{{types[3]}}
                                          </label>
                                      </div>
                                  </div>

                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"><?php _e('Период', 'earena'); ?>
                          <div class="row" style="padding-left:10px">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px;">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.period.from"
                                         type="date" name="start_reg"
                                         style="padding: 10px 5px; padding-left: 0"
                                         placeholder="<?php _e('Начало', 'earena'); ?>">
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px;">
                                  <input
                                      @change="changeForm"
                                      @input="changeForm"
                                      v-model="formData.period.to"
                                      type="date" name="end_reg"
                                      style="padding: 10px 5px; padding-left: 0"
                                      placeholder="<?php _e('Конец', 'earena'); ?>">
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12"><?php _e('Прибыль', 'earena'); ?>
                          <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.profit.from"
                                         style="padding: 10px 5px"
                                         class="center"
                                         name="profit_from" type="number"
                                         placeholder="<?php _e('От', 'earena'); ?>"/>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding: 10px 5px">
                                  <input @change="changeForm" @input="changeForm" v-model="formData.profit.to"
                                         style="padding: 10px 5px"
                                         class="center"
                                         name="profit_to" type="number"
                                         placeholder="<?php _e('До', 'earena'); ?>"/>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12 justify-content-between" style="display:flex;">
                          <div v-if="formData.type === '1'" class="checkboxes d-flex">
                              <label class="box_ckeck check_tour" style="margin: 15px 20px 0 0">
                                  <input @change="changeForm" type="checkbox" class="game1" name="tournament"
                                         required="required"
                                         v-model="formData.tournament">
                                  <span class="checkmark"></span>
                                  <?php _e('Турнир', 'earena'); ?>
                              </label>
                              <label class="box_ckeck check_tour" style="margin: 15px 20px 0 0  ">
                                  <input @change="changeForm" type="checkbox" class="game1" name="cup"
                                         required="required"
                                         v-model="formData.cup">
                                  <span class="checkmark"></span>
                                  <?php _e('Кубок', 'earena'); ?>
                              </label>
                              <label class="box_ckeck check_tour" style="margin: 15px 20px 0 0  ">
                                  <input @change="changeForm" type="checkbox" class="game1" name="lc"
                                         required="required"
                                         v-model="formData.lc">
                                  <span class="checkmark"></span>
                                  <?php _e('Lucky CUP', 'earena'); ?>
                              </label>
                          </div>
                          <div v-if="formData.type !== '1'" class="checkboxes d-flex">
                          </div>
                          <div @click="reset" class="reset" style="margin-top: 15px; font-weight: 700">
                              <?php _e('Сбросить', 'earena'); ?>
                          </div>
                      </div>
                  </div>
              </form>
          </div>

          <div class="table-responsive">
              <table class="table table--statistic table-rezult">
                  <thead>
                  <tr>
                      <th @click="sortBy(0)" class="" :class=" sort === 0 ? orderBy : ''"><?php _e('ID', 'earena'); ?></th>
                      <th @click="sortBy(1)" class="" :class=" sort === 1 ? orderBy : ''"><?php _e('Тип', 'earena'); ?></th>
                      <th @click="sortBy(2)" class="" :class=" sort === 2 ? orderBy : ''"><?php _e('Прибыль', 'earena'); ?></th>
                      <th @click="sortBy(3)" class="" :class=" sort === 3 ? orderBy : ''"><?php _e('Дата', 'earena'); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr class="display: none"></tr>

                  <tr v-key="item.ID" v-for="(item, index) in items">
                      <!-- <td><a :href="'<?= home_url('/') ?>user/'+item.ID">{{item.ID}}</a></td> -->
                      <td style="white-space: nowrap">{{item.ID}} | {{tableLabels[item.type]}} <span
                                  v-if="item.type === 'tournament' && item.tournament_type !== 1"> ({{tableLabels.type[item.tournament_type-1]}})</span>
                      </td>
                      <td>
                          <div v-if="item.type === 'tournament'">
                              {{tableLabels.type[item.tournament_type-1]}}
                          </div>
                      </td>
                      <td>{{item.profit}}</td>
                      <td>{{item.date}}</td>
                  </tr>
                  </tbody>
              </table>
          </div>
      </div>
      <div id="isInViewPort">
          <div v-if="load" id="loading-indicator" style="width: 60px; height: 60px;" role="progressbar"
               class="MuiCircularProgress-root MuiCircularProgress-colorPrimary MuiCircularProgress-indeterminate">
              <svg viewBox="22 22 44 44" class="MuiCircularProgress-svg">
                  <circle cx="44" cy="44" r="20.2" fill="none" stroke-width="3.6"
                          class="MuiCircularProgress-circle MuiCircularProgress-circleIndeterminate"></circle>
              </svg>
          </div>
      </div>
  </div>
</main>

<script>
    const app_create_tournament = new Vue({
        el: '#app_create_tournament',
        data: {
            activeTab: 2,
            load: false,
            sort: false,
            page: 1,
            total: 0,
            orderBy: 'ASC',
            items: [],
            formData: {
                id: '',
                cup: false,
                lc: false,
                tournament: false,
                type: 0,
                profit: {},
                period: {},
            },
            ddflag: {
                0: false,
                1: false,
                2: false,
                3: false,
            },
            playerCount: 0,
            testCount: 0,
            timeout: null,
            hasPages: true,
            types: [
                '<?php _e('Все операции', 'earena'); ?>',
                '<?php _e('Турниры', 'earena'); ?>',
                '<?php _e('Матчи', 'earena'); ?>',
                '<?php _e('VIP-статусы', 'earena'); ?>',
            ],
            labels: [
                '<?php _e('Операций: ', 'earena'); ?>',
                '<?php _e('Турниров: ', 'earena'); ?>',
                '<?php _e('Матчей: ', 'earena'); ?>',
                '<?php _e('VIP-статусов:', 'earena'); ?>',
            ],
            tableLabels: {
                type: [
                    '<?php _e('Обычный', 'earena'); ?>',
                    '<?php _e('Lucky cup', 'earena'); ?>',
                    '<?php _e('Кубок', 'earena'); ?>',
                ],
                tournament: '<?php _e('Турнир', 'earena'); ?>',
                match: '<?php _e('Матч', 'earena'); ?>',
                vip: '<?php _e('VIP-статус', 'earena'); ?>',
            },
        },
        methods: {
            reset() {
                this.formData = {
                    id: '',
                    cup: false,
                    lc: false,
                    tournament: false,
                    type: 0,
                    profit: {},
                    period: {},
                }
                this.ajaxSend()
            },
            sortBy(i) {
                if (i === this.sort) {
                    this.orderBy = this.orderBy === 'ASC' ? 'DESC' : 'ASC'
                } else {
                    this.sort = i
                }
                this.ajaxSend()
            },
            gelFlag(id) {
                return '<?= get_template_directory_uri(); ?>/assets/img/flags/flag-' + id + '.svg'
            },
            clearId() {
                this.formData.id = ''
                this.changeForm()
            },
            id(e) {
                if (this.formData.id.length < 3) {
                    return false
                }
                this.changeForm(e)
            },
            changeForm(e) {
                if (this.load) {
                    e.preventDefault()
                    e.stopPropagation()
                }
                if (e.target && e.target.name === 'type') {
                    this.formData.cup = false
                    this.formData.lc = false
                    this.formData.tournament = false
                }
                this.ddflag[0] = false
                this.page = 1
                this.hasPages = true
                this.ajaxSend()
            },
            loadMore() {
                if (!this.hasPages || this.load) {
                    return false
                }
                this.page = this.page + 1
                this.ajaxSend()
            },
            ajaxSend() {
                if (this.load) {
                    return false
                }
                this.load = true
                const form_data = new FormData()
                form_data.append('action', 'getFinansist')
                form_data.append('page', this.page)
                form_data.append('orderby', this.sort)
                form_data.append('order', this.orderBy)
                for (let prop in this.formData) {
                    form_data.append(prop, this.formData[prop])
                }
                form_data.append('profitfrom', this.formData.profit.from)
                form_data.append('profitto', this.formData.profit.to)
                form_data.append('periodfrom', this.formData.period.from)
                form_data.append('periodto', this.formData.period.to)

                if (this.timeout) clearTimeout(this.timeout)
                this.timeout = setTimeout(() => {
                    this.sendHandler(form_data)
                }, 1500)
            },

            sendHandler(data) {
              for(var pair of data.entries()) {
                 console.log(pair[0]+ ', '+ pair[1]);
              }
                axios.post(earena_2_ajax.url, data)
                    .then((response) => {
                        const data = response.data.table
                        if (this.page === 1) {
                            this.items = data
                        } else {
                            if (data.length == 0) {
                                this.hasPages = false
                            }
                            for (let i = 0; i < data.length; i++) {
                                this.items.push(data[i])
                            }
                        }
                        this.load = false
                        this.testCount = response.data.counters.total
                    })
                    .catch(function (error) {
                        console.log(error)
                        this.load = false
                    })

            },
            gambitGalleryIsInView(el) {
                const scroll = window.scrollY || window.pageYOffset
                const boundsTop = el.getBoundingClientRect().top + scroll

                const viewport = {
                    top: scroll,
                    bottom: scroll + document.documentElement.clientHeight,
                }

                const bounds = {
                    top: boundsTop,
                    bottom: boundsTop + el.clientHeight,
                }

                return (bounds.bottom >= viewport.top && bounds.bottom <= viewport.bottom)
                    || (bounds.top <= viewport.bottom && bounds.top >= viewport.top)
            },
        },
        mounted() {
            this.ajaxSend()

            const raf =
                window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                function (callback) {
                    window.setTimeout(callback, 1000 / 60)
                }
            const isInViewPort = document.querySelector( '#isInViewPort' )
            const handler = () => raf(() => {
                if (this.gambitGalleryIsInView(isInViewPort)) {
                    this.loadMore()
                }
            })

            handler()
            window.addEventListener('scroll', handler)
        },
        beforeMount() {
        }
    })

</script>
<style>
    #app_create_tournament select,
    #app_create_tournament input {
        margin-top: 0;
    }

    /* .table-rezult.table > thead > tr > th {
        border: none;
        cursor: pointer;
        position: relative;
        padding-left: 12px !important;
        padding-bottom: 10px;
        color: #787878;
        font-family: Montserrat;
        font-style: normal;
        font-weight: 500;
        font-size: 14px;
    }

    .table-rezult tbody {
        background: #FFFFFF;
        border-radius: 20px !important;
    } */

    th:after {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
    }

    .DESC,
    .ASC {
        text-decoration: underline;
    }

    .DESC:before,
    .ASC:before {
        content: "";
        border-style: solid;
        position: absolute;
        left: 0px;
        top: 50%;
        transform: translateY(-50%);
    }

    .ASC:before {
        border-width: 0 5px 10px 5px;
        border-color: transparent transparent #787878 transparent;
    }

    .DESC:before {
        border-width: 10px 5px 0 5px;
        border-color: #787878 transparent transparent transparent;
    }


    .input-group-addon {
        background-color: transparent;
        border: none;
        z-index: 99999;
        position: absolute;
        bottom: 0;
    }

    table.table-rezult tr td .icons {
        text-align: right !important;
        display: flex;
        justify-content: end;
        align-items: center;
    }

    .icons span {
        width: 20px;
        height: 20px;
        margin: 0;
        padding: 0;
        margin-right: 3px;
        font-family: Montserrat;
        font-style: normal;
        font-weight: bold;
        font-size: 10px;
        line-height: 16px;
        text-align: center;
        color: #D62D30;
        display: block !important;
        float: unset;
        text-align: center;
        background-size: cover;
    }

    .icons span.yellow_cards {
        border: 2px solid #D62D30;
        border-radius: 50px;
    }

    .icons span.vip,
    .icons span.verified,
    .icons span.block,
    .icons span.test {
      position: static;
      padding: 0;
      margin: 0;
      background: none;
      border: none;
      cursor: pointer;
      text-align: center;
      vertical-align: middle;
      outline: none;

      width: 24px;
      height: 24px;
      border-radius: 50%;

      background-size: contain;
      background-position: center;
      background-repeat: no-repeat;
      background-size: 58.33333333%;
    }

    .icons span.vip {
      background-color: #E37525;
      background-image: url( <?= get_template_directory_uri(); ?>/assets/img/tournaments-crown.svg);
    }

    .icons span.verified {
      background-color: #4890E4;

      background-image: url( <?= get_template_directory_uri(); ?>/assets/img/check.svg);
    }

    .icons span.block {
      background-color: #cf3939;

      background-image: url( <?= get_template_directory_uri(); ?>/assets/img/block.svg);
    }

    .icons span.test {
        background-color: #222d43;
        background-image: url(<?= get_template_directory_uri(); ?>/assets/img/test.svg);
    }

    .select-box {
        margin-top: 15px;
    }

    .stop {
        pointer-events: none;
        opacity: .2;
        cursor: wait;
    }

    .top-for-scroll {
        background-color: #4C2C8F;
        background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAAAj0lEQVRIie2TQQqAIBBF/3QxjxNtoqNkm+qy/TYTWWipuIn8IMig7zkwAr8KSSEpKXeaFDiAEcCcKomCk7Q8sxSTeODlJDf45sCPvc2WeOC9I2gdSXonPrjWSZK6z5OE4HdBrCQ0ptQ1iMgUeoyIrAA6PRsf7cJ46pcOnLopMrYhwVOif3JuqqAKPiCoec0OShkJTpttr90AAAAASUVORK5CYII=");
        background-size: cover;
        position: fixed;
        right: 20px;
        bottom: 20px;
        width: 25px;
        height: 25px;
        border-radius: 4px;
    }

    body, html {
        scroll-behavior: smooth;
    }

    .vertical-center {
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: auto;
    }

    .finansist div {
        font-weight: normal;
        font-size: 14px;
        line-height: 1.4em;
        margin-right: 21px;
    }

    .finansist div:last-child {
        margin-left: auto;
        margin-right: 0;
    }

    .finansist {
        box-shadow: 0 3px 4px rgba(0, 0, 0, .1);
        background: #FFFFFF;
        border-radius: 20px;
        padding: 20px 25px;
        position: relative;
        margin-bottom: 40px;
        display: flex;
        flex-wrap: wrap;
    }

    .green {
        color: #00B00D;
    }

    .table.table-rezult td {
        text-align: left !important;
    }
    input[type="date"]::-webkit-datetime-edit {
        padding-left: 5px;
        color: #8a8a8a;
    }
    div.reset {
        color: #007FF3;
        cursor: pointer;
    }
@media (max-width: 992px) {
    ul.menu-tab li {
        min-width: 30%;
    }
    .preload {
        min-width: 100%;
    }
    .id-search-container {
        flex-direction: column;
    }
    .id-search {
        min-width: 100%;
    }
}
</style>

<?php
wp_enqueue_style( 'stats-styles', get_template_directory_uri() . '/assets/libs/stats.css' );
get_footer();
?>
