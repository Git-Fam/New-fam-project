
cooperator

cooperator-2

をそれぞれ用意済み

それぞれのディレクトリ内なら、自由にカスタム可能



_ex_mixins.scss
_ex_variables.scss
_example.scss
_index.scss

を用意済み

_ex_mixins.scss
↓
独自のmixinを記述するファイル

_ex_variables.scss
↓
独自の変数を記述するファイル

_example.scss
↓
独自のスタイルを記述するファイル（名前変更して使用して）

_index.scss
↓
cooperator or cooperator-2のscssファイルforwardして、style.scssへuseするファイル
_example.scssなど名前へ変更したら、_index.scss内のforward先も変更すること
ファイルを追加したら、_index.scss内にforwardを追記すること