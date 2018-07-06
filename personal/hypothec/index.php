<?

defined('NEED_AUTH') or define('NEED_AUTH', true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';

$APPLICATION->SetTitle('Оформить ипотеку');
?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <? \Lema\Components\Breadcrumbs::inc('breadcrumbs'); ?>
            </div>
        </div>
    </div>
    <div class="container">
        <form class="filter-form form-admin anketa js-hypothec-form"
              action="<?=SITE_DIR."ajax/personal_hypothec_form.php";?>"
              method="POST"
              enctype="multipart/form-data">
            <div class="container-index">
                <div class="section-title form-title">
                    <span>
                        Личная информация
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Имя</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="NAME" class="filter-price-input filter-max-value-input"
                               placeholder="Ваше имя">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Отчество</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="PATRONUMIC" class="filter-price-input filter-max-value-input"
                               placeholder="Ваше отчество">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Фамилия</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="SURNAME" class="filter-price-input filter-max-value-input"
                               placeholder="Введите свою фамилию">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">

                    <div class="filter-field-title">Дата рождения</div>
                    <div class="filter-price it-block">
                        <input type="date" value="" name="date" id="date"
                               class="filter-price-input filter-max-value-input" placeholder="Дата рождения">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">№ телефона</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="PHONE" class="filter-price-input filter-max-value-input btn-accept"
                               placeholder="№ телефона">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Email</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="EMAIL" class="filter-price-input filter-max-value-input"
                               placeholder="Email">
                        <div class="it-error"></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Уровень образования</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <li data-value="1">ниже среднего</li>
                            <li data-value="2">среднее</li>
                            <li data-value="3">средне специальное</li>
                            <li data-value="4">неоконченное высшее</li>
                            <li data-value="49">высшее</li>
                            <li data-value="50">несколько высших</li>
                            <li data-value="51">ученая степень/МВА</li>
                            <li data-value="152">аспирантура</li>
                        </ul>
                        <input type="hidden" name="EDUCATION_LEVEL" value="">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Семейное положение</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <li data-value="1">женат/замужем</li>
                            <li data-value="2">холост/не замужем</li>
                            <li data-value="3">вдовец/вдова</li>
                            <li data-value="4">гражданский брак</li>
                            <li data-value="49">разведен/разведена</li>
                        </ul>
                        <input type="hidden" name="MARITAL_STATUS" value="">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title object-number">Брачный договор</div>
                    <div class="filter-num-rooms it-block">
                        <input name="MARRIAGE_CONTRACT" type="radio" id="n1" value="1" class="filter-input">
                        <label for="n1" class="filter-label">да</label>
                        <input name="MARRIAGE_CONTRACT" type="radio" id="n2" value="2" class="filter-input">
                        <label for="n2" class="filter-label">нет</label>
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Количество детей до 18 лет</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="QUANTITY_MINOR_CHILDREN" class="filter-price-input filter-max-value-input"
                               placeholder="Количество детей до 18 лет">
                        <div class="it-error"></div>
                    </div>
                </div>
            </div>
            <div class="container-index">
                <div class="section-title form-title">
                    <span>
                        Место проживания
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Область/Край</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="REGION" class="filter-price-input filter-max-value-input"
                               placeholder="Область/Край ">
                        <div class="it-error"></div>
                    </div>

                    <div class="filter-field-title">Город/Поселок</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="CITY" class="filter-price-input filter-max-value-input"
                               placeholder="Город/Поселок">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Статус жилья</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <li data-value="1">Собственное жилье</li>
                            <li data-value="2">Аренда</li>
                            <li data-value="3">Социальный найм</li>
                            <li data-value="4">Жилье родственников</li>
                            <li data-value="49">Коммунальная квартира</li>
                            <li data-value="4">Общежитие</li>
                            <li data-value="49">Воинская часть</li>
                        </ul>
                        <input type="hidden" name="STATUS_HOUSING" value="">
                        <div class="it-error"></div>
                    </div>
                </div>
            </div>

            <div class="container-index">
                <div class="section-title form-title">
                    <span>
                        Служебная информация
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Тип занятости</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <li data-value="1">Наемный работник</li>
                            <li data-value="2">ИП</li>
                            <li data-value="3">Собственный бизнес</li>
                            <li data-value="4">Пенсионер</li>
                        </ul>
                        <input type="hidden" name="EMPLOYMENT_TYPE" value="">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Тип трудового договора</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <li data-value="1">срочный (на определенный срок/сезон)</li>
                            <li data-value="2">бессрочный (постоянная занятость)</li>
                        </ul>
                        <input type="hidden" name="TYPE_LABOR_CONTRACT" value="">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Стаж на текущем месте работы (в месяцах)</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="EXPERIENCE_CURRENT_WORK" class="filter-price-input filter-max-value-input"
                               placeholder="Стаж">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Общий трудовой стаж (месяцах)</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="EXPERIENCE_TOTAL" class="filter-price-input filter-max-value-input"
                               placeholder="Стаж общий">
                        <div class="it-error"></div>
                    </div>
                </div>
            </div>
            <div class="container-index">
                <div class="section-title form-title">
                    <span>
                        Информация о доходах
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Зарплатный проект банка</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <li data-value="1">ПАО «Сбербанк»</li>
                            <li data-value="2">ПАО «Втб24»</li>
                            <li data-value="3">ПАО «Банк Москвы»</li>
                            <li data-value="4">АО «Россельхозбанк»</li>
                            <li data-value="5">ПАО «Дальневосточный банк»</li>
                            <li data-value="6">АО «Газпромбанк»</li>
                            <li data-value="7">ПАО «Росбанк»</li>
                            <li data-value="8">ПАО «Азиатско-тихоокеанский банк»</li>
                        </ul>
                        <input type="hidden" name="SALARY_PROJECT_BANK" value="">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Основная заработная плата</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="BASIC_SALARY" class="filter-price-input filter-max-value-input"
                               placeholder="Основная заработная плата">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Дополнительные доходы</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="ADDITIONAL_INCOME" class="filter-price-input filter-max-value-input"
                               placeholder="Дополнительные доходы">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Доход семьи</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="FAMILY_INCOME" class="filter-price-input filter-max-value-input"
                               placeholder="Доход семьи">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Способ подтверждения дохода</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <li data-value="1">Справка 2-НДФЛ</li>
                            <li data-value="2">Справка по форме банка</li>
                        </ul>
                        <input type="hidden" name="METHOD_INCOME_CONFIRMATION" value="">
                        <div class="it-error"></div>
                    </div>
                </div>
            </div>
            <div class="container-index">
                <div class="section-title form-title">
                    <span>
                        Информация о запрашиваемом ипотечном кредите
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="filter-field-title">Программа кредитования</div>
                    <div class="filter-select it-block">
                        <a href="#" class="filter-select-link filter-border-color">Выбрать</a>
                        <ul class="filter-select-drop">
                            <li data-value="">Выбрать</li>
                            <li data-value="1">приобретения готового жилья</li>
                            <li data-value="2">приобретение строящегося жилья</li>
                            <li data-value="3">кредит под залог недвижимости»</li>
                            <li data-value="4">строительство жилого дома</li>
                            <li data-value="5">загородная недвижимость</li>
                        </ul>
                        <input type="hidden" name="PROGRAM_CREDIT" value="">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Запрашиваемая сумма</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="REQUESTED_AMOUNT" class="filter-price-input filter-max-value-input"
                               placeholder="Запрашиваемая сумма">
                        <div class="it-error"></div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Срок кредита</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="CREDIT_TERM" class="filter-price-input filter-max-value-input"
                               placeholder="Срок кредита">
                        <div class="it-error"></div>
                    </div>
                    <div class="filter-field-title">Стоимость объекта недвижимости</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="PRICE_REAL_ESTATE_OBJECT" class="filter-price-input filter-max-value-input"
                               placeholder="Стоимость объекта недвижимости">
                        <div class="it-error"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="filter-field-title">Сумма первоначального взноса</div>
                    <div class="filter-price it-block">
                        <input type="text" value="" name="AMOUNT_INITIAL_CONTRIBUTION" class="filter-price-input filter-max-value-input"
                               placeholder="Сумма первоначального взноса">
                        <div class="it-error"></div>
                    </div>
                </div>

                <div class="col-md-6 it-block">
                    <div class="filter-field-title">Загрузить документ</div>
                    <div class="file-upload">
                        <label>
                            <input type="file" name="file" accept=".doc,.docx,.xml,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                            <span>Выберите файл</span>
                        </label>
                    </div>
                    <div class="it-error"></div>
                </div>

            </div>


            <div class="text-center margin30">
                <button type="submit" name="" value="" class="filter-submit-btn margin30 btn-reset">Отменить</button>
                <button type="submit" name="" value="" class="filter-submit-btn margin30 btn-save">Сохранить</button>
            </div>
        </form>
    </div>
<?
require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';
?>