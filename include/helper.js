document.addEvent('domready', function(){
        $$('div[class^=contactme] input[type=button]').addEvent('click', function(){
            var f = this.getParent('form');
            if (document.formvalidator.isValid(f)){
                f.getElement('input[name^=contactmeaction]').set('value', 1);
                f.getElement('input[name=check]').set('value', f.getElement('input[name=token]').get('value'));
                f.submit();
            }

        })
})


