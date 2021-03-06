<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.buttons-votee .button', function () {
            var btn = $(this);
            btn.addClass('loading');
            btn.siblings().andSelf().addClass('disabled').attr('disabled', true);

            $.ajax({
                        url: btn.data('url'),
                        type: "POST",
                        dataType: 'json',
                        data: {id: btn.data('id'), type: btn.data('type')}
                    })
                    .done(function (response, status, xhr) {
                        if (xhr.status == 200) {
                            btn.parent().find('.total-up').html(response.data.vote_up);
                            btn.parent().find('.total-down').html(response.data.vote_down);
                            btn.parent().find('.button-vote').removeClass('green red');

                            switch (response.data.value) {
                                case {{ config('votee.values.up') }}:
                                    btn.parent().find('.button-vote-up').addClass('green');
                                    break;
                                case {{ config('votee.values.down') }}:
                                    btn.parent().find('.button-vote-down').addClass('red');
                                    break;
                                case {{ config('votee.values.neutral') }}:
                                    break;
                            }
                        } else {
                            btn.popup({html: xhr.responseJSON.message}).popup('show');
                        }
                    })
                    .fail(function (xhr) {
                        btn.popup({content: xhr.responseJSON.message}).popup('show');
                    })
                    .always(function () {
                        btn.siblings().andSelf().removeClass('disabled').removeAttr('disabled');
                        btn.removeClass('loading');
                    });
        });

        $('.button-vote').popup({
            on: 'manual'
        });

    })
</script>
