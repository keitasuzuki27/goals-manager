function ViewModel() {
  this.password = ko.observable('');

  this.passwordError = ko.computed(() => {
    if (this.password().length === 0) return '';
    if (this.password().length < 8) return 'パスワードは8文字以上必要です';
    return '';
  });
}

ko.applyBindings(new ViewModel());