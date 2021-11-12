/*
  is_user_logged_in,
  is_ea_admin,

  dataGames,
  currentGameId,

  isProfile,
  siteURL,
  siteThemeFolderURL,
  ea_icons
  platformsArr

  isAdminTournamentsList

  - глобальные переменные, которые используются для составления URI.
    Задаются в header.php
*/
const { __, _x, _n, _nx } = wp.i18n;

const app_create_tournament = new Vue({
  el: '#app_create_tournament',
  data: {
    bots_play: '',
    no_private: '',
    add_now: '',
    all_games: '',
    qty: '',
    qtyVal: '',
    qtyValMin: '',
    qtyValMax: '',
    top: 0,
    vip: 0,
    verification: 0,
    activeTab: 1,
    activeSubTab: 1,
    name: '',
    description: '',
    our_percent: '',
    private: false,
    password: '',
    togglePassword: true,
    color: 'transparent',
    brand: false,
    game: '',
    platform: '',
    max_players: '',
    price: '',
    random: '',
    randomArr: [
      { value: 0, label: __('Простой', 'earena') },
      { value: 1, label: __('Random', 'earena') },
    ],
    garant: '',
    fast: '',
    fastArr: [
      { value: 0, label: __('Обычная', 'earena') },
      { value: 1, label: __('Fast', 'earena') },
    ],
    periodArr: [
      { value: 'daily', label: __('Каждый день', 'earena') },
      { value: 'weekly', label: __('Каждую неделю', 'earena') },
      { value: 'monthly', label: __('Каждый месяц', 'earena') },
    ],
    universalArr: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    universalSelectActive: '',
    game_mode: '',
    team_mode: '',
    start_reg_date: '',
    start_reg_time: '',
    end_reg_date: '',
    end_reg_time: '',
    start_date: '',
    start_time: '',
    period: '',
    match_time_d: '',
    match_time_h: '',
    match_time_m: '',
    moderation_time_d: '',
    moderation_time_h: '',
    moderation_time_m: '',
    reglament: 'bo1',
    reglamentArr: [
      { value: 'bo1', label: __('ВО 1', 'earena') },
      { value: 'bo3', label: __('ВО 3', 'earena') },
    ],
    universal: 0,
    // ajaxUrl: earena_2_ajax.url,
    // nonce: earena_2_ajax.nonce_create_tournament,
    gamesArr: dataGames,
    directory: siteThemeFolderURL,
    platformsArr: platformsArr,
    team_modes: [
      { value: 1, label: __('Обычные', 'earena') },
      { value: 2, label: __('MyClub', 'earena') },
      { value: 3, label: __('UltimateTeam', 'earena') },
    ],
  },
  computed: {
    currentGame () {
      return this.game === '' ? {} : this.gamesArr[this.game]
    },
    currentPlatform () {
      return this.platform === '' ? {} : this.platformsArr[this.platform]
    },
  },
  watch: {
    activeTab: {
      deep: true,
      handler: function (v) {
        switch (this.activeTab) {
          case 1: {
            this.reglament = 'bo1'
            this.randomArr = [
              { value: 0, label: __('Простой', 'earena') },
              { value: 1, label: __('Random', 'earena') },
            ]
            this.fastArr = [
              { value: 0, label: __('Обычная', 'earena') },
              { value: 1, label: __('Fast', 'earena') },
            ]
            this.reglamentArr = [
              { value: 'bo1', label: __('ВО 1', 'earena') },
              { value: 'bo3', label: __('ВО 3', 'earena') },
            ]
            this.random = ''
            this.fast = ''
            this.max_players = ''
            this.activeSubTab = 1
            this.universal = ''
            this.universalSelectActive = ''
            break
          }
          case 2: {
            this.reglament = 'r1'
            this.randomArr = [
              { value: 0, label: __('Простой', 'earena') },
              { value: 1, label: __('Random', 'earena') },
            ]
            this.fastArr = [
              { value: 0, label: __('Обычная', 'earena') },
              { value: 1, label: __('Fast', 'earena') },
            ]
            this.reglamentArr = [
              { value: 'r1', label: __('1 круг', 'earena') },
              { value: 'r2', label: __('2 круга', 'earena') },
            ]
            this.random = ''
            this.fast = ''
            this.max_players = ''
            this.activeSubTab = 1
            this.universalSelectActive = ''
            break
          }
          case 3: {
            this.reglament = 'bo1'
            this.randomArr = [
              { value: 1, label: __('Random', 'earena') },
            ]
            this.fastArr = [
              { value: 1, label: __('Fast', 'earena') },
            ]
            this.reglamentArr = [
              { value: 'bo1', label: __('ВО 1', 'earena') },
            ]
            this.random = ''
            this.fast = ''
            this.max_players = 4
            this.activeSubTab = 1
            this.universal = ''
            this.universalSelectActive = ''
            break
          }
        }

        setTimeout(function () {
          window.select.reActivateInputs('random,fast');
        }, 500)
      }
    },
    activeSubTab : {
      deep: true,
      handler: function (v) {
        // let selectUniversalTournamentContainer = document.querySelector('.form__section-tabs--universal');
        // if (this.activeSubTab === 2 && this.universalSelectActive === '' && selectUniversalTournamentContainer) {
        //   window.select.search(selectUniversalTournamentContainer);
        //   this.universalSelectActive = 1;
        // }
      }
    }
  },
  methods: {
    sendHandler (event) {
      event.stopPropagation()
      event.preventDefault()

      let data = new FormData()
      // data.append('file_1', this.$refs.filePhoto1.files[0])
      // data.append('file_2', this.$refs.filePhoto2.files[0])
      // if (this.activeTab !== 3) {
      //
      //   data.append('file_3', this.$refs.filePhoto3.files[0])
      //   data.append('file_4', this.$refs.filePhoto4.files[0])
      //   data.append('bg_color', this.color)
      //
      // }
      // data.append('action', 'ajax_new_tournament')
      // data.append('nonce', this.nonce)
      // data.append('tab_id', this.activeTab)
      // data.append('vip', this.vip)
      // data.append('t_name', this.name)
      // data.append('description', this.description)
      // data.append('our_percent', this.our_percent)
      // data.append('garant', this.garant)
      // data.append('private', this.private)
      // if (this.private) {
      //   data.append('pass', this.password)
      // }
      // data.append('game', parseInt(this.game))
      // data.append('platform', parseInt(this.platform))
      // data.append('price', this.price)
      // data.append('max_players', this.max_players)
      // data.append('game_mode', this.game_mode)
      // data.append('team_mode', this.team_mode)
      // data.append('random', this.random)
      // data.append('fast', this.fast)

      // data.append('start_reg_time', this.start_reg_date + 'T' + this.start_reg_time)
      // data.append('end_reg_time', this.end_reg_date + 'T' + this.end_reg_time)
      // data.append('start_time', this.start_date + 'T' + this.start_time)
      // data.append('period', this.period)
      // data.append('universal', this.universal)
      // data.append('round_time', this.match_time_d + '-' + this.match_time_h + '-' + this.match_time_m)
      // data.append('moderation_time', this.moderation_time_d + '-' + this.moderation_time_h + '-' + this.moderation_time_m)
      // data.append('reglament', this.reglament)
      //
      // data.append('top', this.top ? 1 : 0)

      // data.append('verification', this.verification ? 1 : 0)

      data.append('qty', this.qty)
      data.append('qtyVal', this.qtyVal)
      data.append('qtyValMin', this.qtyValMin)
      data.append('qtyValMax', this.qtyValMax)
      data.append('bots_play', this.bots_play)
      data.append('no_private', this.no_private)
      data.append('add_now', this.add_now)
      data.append('all_games', this.all_games)

      let $reply = $('div.ajax-reply')
      //
      $reply.text('Загружаю...')
      $.ajax({
        // url: this.ajaxUrl,
        type: 'POST',
        data: data,
        cache: false,
        dataType: 'json',
        processData: false,
        contentType: false,
        success: function (respond, status, jqXHR) {
          if (respond.success) {
            $reply.text('УСПЕШНО: ')
            $.each(respond.data, function (key, val) {
              $reply.append('<center><p>' + val + '</p></center>')
            })
          } else {
            $reply.text('ОШИБКА: ' + respond.data)
          }
        },
        error: function (jqXHR, status, errorThrown) {
          $reply.text('ОШИБКА AJAX запроса: ' + status)
        }
      })
    }
  },
  mounted () {
  },
  beforeMount () {
  }
})
