
      <!-- 共通footer -->
        <footer class="C_footer">
            <div class="C_footer--menu">
                <div class="C-title C-title--white">
                    <h2>SALON INFO</h2>
                </div>
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3240.3053021290725!2d139.70446307644892!3d35.69410397258316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sja!2sjp!4v1704375335265!5m2!1sja!2sjp" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>

                <div class="C_footer--menu--excerpt">
                    <div class="C_footer--menu--excerpt--section">
                        <div class="C_footer--menu--excerpt--section--address">
                            <h3>中部治療院</h3>
                            <p>
                                〒460-0008<br>
                                名古屋市中区栄1丁目25-28<br class="sp">シャトー白川10F<br>
                                ※エレベーターで10階まで上ると、左奥に中部治療院・白川美容研究所の表札があります。
                            </p>
                            <a href="<?php bloginfo('url'); ?>/#" class="hover-opa"></a>
                        </div>
                        <div class="C_footer--menu--excerpt--section--calendar">

                            <div class="C_footer--menu--excerpt--section--calendar--content">

                                  <?php 
                                    $calendar_No = 'calendar_';
                                    $pageID = 55; 
                                    $switch = 'true';
                                  ?>
                                  
                                <div class="C_footer--menu--excerpt--section--calendar--content--item">
                                    <p class="ad"><?php echo get_post_meta($pageID, $calendar_No.'1', $switch); ?></p>
                                    <table class="calendar">
                                        <thead>
                                          <tr>
                                            <th>日</th>
                                            <th>月</th>
                                            <th>火</th>
                                            <th>水</th>
                                            <th>木</th>
                                            <th>金</th>
                                            <th>土</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_1_color_1', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_1_day_1', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_1_color_2', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_1_day_2', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_1_color_3', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_1_day_3', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_1_color_4', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_1_day_4', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_1_color_5', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_1_day_5', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_1_color_6', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_1_day_6', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_1_color_7', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_1_day_7', $switch); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_2_color_1', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_2_day_1', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_2_color_2', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_2_day_2', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_2_color_3', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_2_day_3', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_2_color_4', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_2_day_4', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_2_color_5', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_2_day_5', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_2_color_6', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_2_day_6', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_2_color_7', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_2_day_7', $switch); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_2_color_1', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_3_day_1', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_3_color_2', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_3_day_2', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_3_color_3', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_3_day_3', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_3_color_4', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_3_day_4', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_3_color_5', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_3_day_5', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_3_color_6', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_3_day_6', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_3_color_7', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_3_day_7', $switch); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_4_color_1', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_4_day_1', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_4_color_2', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_4_day_2', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_4_color_3', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_4_day_3', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_4_color_4', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_4_day_4', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_4_color_5', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_4_day_5', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_4_color_6', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_4_day_6', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_4_color_7', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_4_day_7', $switch); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_5_color_1', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_5_day_1', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_5_color_2', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_5_day_2', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_5_color_3', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_5_day_3', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_5_color_4', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_5_day_4', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_5_color_5', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_5_day_5', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_5_color_6', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_5_day_6', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_1_week_5_color_7', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_1_week_5_day_7', $switch); ?>
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="C_footer--menu--excerpt--section--calendar--content--item">
                                    <p class="ad"><?php echo get_post_meta($pageID, $calendar_No.'2', $switch); ?></p>
                                    <table class="calendar">
                                        <thead>
                                          <tr>
                                            <th>日</th>
                                            <th>月</th>
                                            <th>火</th>
                                            <th>水</th>
                                            <th>木</th>
                                            <th>金</th>
                                            <th>土</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_1_color_1', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_1_day_1', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_1_color_2', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_1_day_2', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_1_color_3', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_1_day_3', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_1_color_4', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_1_day_4', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_1_color_5', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_1_day_5', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_1_color_6', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_1_day_6', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_1_color_7', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_1_day_7', $switch); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_2_color_1', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_2_day_1', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_2_color_2', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_2_day_2', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_2_color_3', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_2_day_3', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_2_color_4', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_2_day_4', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_2_color_5', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_2_day_5', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_2_color_6', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_2_day_6', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_2_color_7', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_2_day_7', $switch); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_2_color_1', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_3_day_1', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_3_color_2', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_3_day_2', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_3_color_3', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_3_day_3', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_3_color_4', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_3_day_4', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_3_color_5', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_3_day_5', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_3_color_6', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_3_day_6', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_3_color_7', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_3_day_7', $switch); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_4_color_1', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_4_day_1', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_4_color_2', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_4_day_2', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_4_color_3', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_4_day_3', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_4_color_4', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_4_day_4', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_4_color_5', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_4_day_5', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_4_color_6', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_4_day_6', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_4_color_7', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_4_day_7', $switch); ?>
                                            </td>
                                          </tr>
                                          <tr>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_5_color_1', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_5_day_1', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_5_color_2', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_5_day_2', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_5_color_3', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_5_day_3', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_5_color_4', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_5_day_4', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_5_color_5', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_5_day_5', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_5_color_6', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_5_day_6', $switch); ?>
                                            </td>
                                            <?php $color_code = get_post_meta($pageID, 'calendar_2_week_5_color_7', $switch); ?>
                                            <td style="background: <?php echo esc_attr($color_code); ?>;">
                                              <?php echo get_post_meta($pageID, 'calendar_2_week_5_day_7', $switch); ?>
                                            </td>
                                          </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="C_footer--menu--excerpt--section--calendar--memo">
                                    <span></span>
                                    <p>営業日</p>
                                    <span></span>
                                    <p>定休日</p>
                            </div>
                        </div>
                    </div>
                    <div class="C_footer--menu--excerpt--review">
                        <a href="<?php bloginfo('url'); ?>/#" class="C_footer--menu--excerpt--review--item hover-opa"></a>
                        <a href="<?php bloginfo('url'); ?>/#" class="C_footer--menu--excerpt--review--item hover-opa"></a>
                    </div>
                </div>

                <div class="C_footer--menu--store">

                    <div class="C_footer--menu--store--tel">
                        <div class="C_footer--menu--store--tel--tag">でんわ</div>
                        <div class="C_footer--menu--store--tel--number">
                            <p>ご予約・お問い合わせはこちら</p>
                            <a href="tel:00000000000"><span>でんわ</span>052-203-0701</a>
                        </div>
                        <div class="C_footer--menu--store--tel--reception">
                            <p>
                                電話受付時間：（平日）10:00〜18:00 <br class="sp">完全予約制<br>
                                （土・日・祝）10:00〜17:00<br>
                                休業日：不定休<br>
                                ※施術中は電話に出られないこともございます
                            </p>
                        </div>
                        <div class="C_footer--menu--store--tel--btn">
                            <a href="<?php bloginfo('url'); ?>/#" class="hover-opa">
                                <p>ご予約はこちら</p>
                                <span></span>
                            </a>
                            <a href="<?php bloginfo('url'); ?>/#" class="hover-opa">
                                <p>お問い合わせはこちら</p>
                                <span></span>
                            </a>
                        </div>
                    </div>

                    <div class="C_footer--menu--store--shop">
                        <div class="C_footer--menu--store--shop--tag">みせ</div>

                        <div class="C_footer--menu--store--shop--content">
                            <div class="C_footer--menu--store--shop--content--item">
                                <div class="C_footer--menu--store--shop--content--item--title">
                                    <p>姉妹院はこちら</p>
                                    <h4>aoはり治療院</h4>
                                </div>
                                <div class="C_footer--menu--store--shop--content--item--text">
                                    <p>
                                        この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文文字の大きさ、量を確認するために入れています。
                                    </p>
                                </div>
                            </div>
                            <div class="C_footer--menu--store--shop--content--img"></div>
                        </div>

                    </div>
                    
                </div>
            </div>

            <div class="C_footer--main">

                <nav class="pc">
                    <ul>
                        <li><a href="<?php echo get_home_url(); ?>">トップページ</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/about">中部治療院について</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/menu">メニュー・施術の流れ</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/staff">スタッフ</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/qa">よくある質問</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/voice">お客様の声</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/blog">ブログ</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/access">アクセス・院案内</a></li>
                        <li><a href="<?php bloginfo('url'); ?>/contact">ご予約・お問い合わせ</a></li>
                    </ul>
                </nav>

                <div class="C_footer--main--copy">
                    <p>Copyright(c) 美容鍼・不妊症なら名古屋 栄の中部治療院 All Rights Reserved.</p>
                </div>

                <div class="reCAPTCHA">
                    This site is protected by reCAPTCHA and the Google<a href="https://policies.google.com/privacy">Privacy Policy</a> and<a href="https://policies.google.com/terms">Terms of Service</a> apply.
                </div>
            </div>

            <div class="C_footer--follow sp">
                <a href="<?php bloginfo('url'); ?>/contact" target="_blank" rel="noopener noreferrer"><span></span>本日の予約状況</a>
                <a href="<?php bloginfo('url'); ?>/contact" target="_blank" rel="noopener noreferrer"><span></span>ネット予約</a>
            </div>
        </footer>
    </div>

<?php wp_footer() ?>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/slick.min.js"></script>
    <script src="<?php echo get_stylesheet_directory_uri(); ?>/script.js"></script>
</body>
</html>