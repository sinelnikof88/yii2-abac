/* 
 * Gonnyh Ivan
 * sinelnikof88@gmail.com
 * Developing  by Yii
 * Each line should be prefixed with  * 
 */

class Abac {
    changeRuleFormObject = function () {
      
        $.pjax({
            type: "POST",
            url: '/abac/rule/change',
            data: $('#rule-form').serializeArray(),
            container: "#changeRuleFormObject",
            push: false,
            enablePushState: false,
            timeout: 20000,
            scrollTo: false
        }).done(function () {
            $.pjax({
                type: "POST",
                url: '/abac/rule/change',
                data: $('#rule-form').serializeArray(),
                container: "#relation",
                push: false,
                enablePushState: false,
                timeout: 20000,
                scrollTo: false
            })
        });


    }
    changeRuleFormSubjectbject = function () {

        $.pjax({
            type: "POST",
            url: '/abac/rule/change',
            data: $('#rule-form').serializeArray(),
            container: "#subject",
            push: false,
            enablePushState: false,
            timeout: 20000,
            scrollTo: false
        }).done(function () {
            $.pjax({
                type: "POST",
                url: '/abac/rule/change',
                data: $('#rule-form').serializeArray(),
                container: "#relation",
                push: false,
                enablePushState: false,
                timeout: 20000,
                scrollTo: false
            })
        });
    }
}
abac = new Abac;
