'use strict';
/**
 * Date collection field
 *
 * @author   Nickolay Konchits <nick@drugento.com>
 * @author   Alexander Yurchik <admin@drugento.com>
 * @copyright 2017 Drugento LLC (http://www.drugento.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
define(
    [
        'pim/field',
        'underscore',
        'jquery',
        'text!pim-datecollection-attribute-type/templates/product/field/date-collection',
        'datepicker',
        'pim/date-context'
    ],
    function (
        Field,
        _,
        $,
        stringTemplate,
        Datepicker,
        DateContext
    ) {
        return Field.extend({
            fieldTemplate: _.template(stringTemplate),
            datetimepickerOptions: {
                format: 'dd.MM.yyyy HH:mm',
                defaultFormat: DateContext.get('time').defaultFormat,
                language: DateContext.get('language'),
                pickTime: true,
                pickSeconds: false
            },
            renderInput: function (context) {
                return this.fieldTemplate(context);
            },
            postRender: function () {
                var $fieldInput = this.$('.field-input:first');
                var $tableBody = $fieldInput.find('tbody');
                var self = this;

                $fieldInput.find('.AknDateCollection-addButton').click(function () {
                    this.addRow();
                }.bind(this));

                $tableBody
                    .on('change', '.AknDateCollection-item', this.updateModel.bind(this))
                    .on('change', '.checkbox', this.updateModel.bind(this))
                    .on('click', '.AknDateCollection-item', this.click.bind(this))
                    .on('click', '.AknDateCollection-newItem', this.click.bind(this))
                    .on('click', '.AknDateCollection-deleteButton', function () {
                        $(this).closest('tr').remove();
                        self.updateModel();

                        return false;
                    })
                    .sortable({
                        axis: 'y',
                        cursor: 'move',
                        handle: '.icon-reorder',
                        update: this.updateModel.bind(this),
                        start: function (e, ui) {
                            ui.placeholder.height(ui.helper.outerHeight());
                        },
                        tolerance: 'pointer',
                        helper: function (e, tr) {
                            var originals = tr.children();
                            var helper = tr.clone();
                            helper.children().each(function (index) {
                                $(this).width(originals.eq(index).outerWidth());
                            });
                            return helper;
                        },
                        forcePlaceholderSize: true
                    })
                ;
            },
            addRow: function () {
                var newValues = this.$el.find('.AknDateCollection-newItem');
                var checkboxes = this.$el.find('.week-newItem .checkbox');
                var values = [];
                if (null !== this.getCurrentValue().data) {
                    values = this.getCurrentValue().data;
                }
                var valuesAsObject = {
                    startDate: '',
                    startTime: '',
                    endDate: '',
                    endTime: ''
                };
                for (var i=0; i < newValues.length; i++) {

                    var time = newValues[i].value.trim();
                    if (time) {
                        time = time.split(' ');
                        valuesAsObject[newValues[i].name+'Date'] = time[0];
                        valuesAsObject[newValues[i].name+'Time'] = time[1];
                    }
                }
                var weekdays = [];
                for (var i=0; i < checkboxes.length; i++) {
                    if (checkboxes[i].checked) {
                        weekdays.push(checkboxes[i].name.slice(-2));
                    }
                }
                if (weekdays.length>0) {
                    valuesAsObject.weekdays = weekdays;
                }
                if (Object.keys(valuesAsObject).length > 0) {
                    values.push(valuesAsObject);
                }
                this.setCurrentValue(values);
                this.render();
                this.setFocus();
            },
            click: function (event) {
                var clickedElement = $(event.currentTarget).parent();
                var picker = this.$('.datetimepicker');

                Datepicker.init(picker, this.datetimepickerOptions);
                clickedElement.datetimepicker('show');

                picker.on('changeDate', function (e) {
                    this.updateModel(e);
                }.bind(this));
            },
            updateModel: function () {
                var values = [];
                this.$('.field-input:first .AknDateCollection-items tbody tr').each(function () {
                    var $row = $(this);
                    var inputs = $row.find('.AknDateCollection-item');
                    if (inputs.length === 0 ) {
                        return;
                    }
                    var checkboxes = $row.find('.checkbox');
                    var valueAsObject = {
                        startDate: '',
                        startTime: '',
                        endDate: '',
                        endTime: '',
                        weekdays: []
                    };
                    for (var i=0; i < inputs.length; i++) {
                        var time = inputs[i].value.trim();
                        if (time) {
                            time = time.split(' ');
                            valueAsObject[inputs[i].name+'Date'] = time[0];
                            valueAsObject[inputs[i].name+'Time'] = time[1];
                        }
                    }
                    for (var i=0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked) {
                            valueAsObject.weekdays.push(checkboxes[i].name.slice(-2));
                        }
                    }
                    values.push(valueAsObject);
                });
                this.setCurrentValue(values);
            },
            setFocus: function () {
                this.$('.AknDateCollection-newItem').focus();
            }
        });
    }
);
