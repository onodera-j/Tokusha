document.addEventListener('DOMContentLoaded', () => {
    const typeRadios = document.getElementsByName('answersheet_type');

    // タブのラベル要素（ボタン部分）を取得
    const labelRouteCondition = document.getElementById('label-route-condition'); // 経路・通行条件
    const labelDisallowReason = document.getElementById('label-disallow-reason');   // 不許可経路・理由

    const contentRouteCondition = labelRouteCondition.nextElementSibling;
    const contentDisallowReason = labelDisallowReason.nextElementSibling;

    function toggleTabs() {
        let selectedValue = "";
        typeRadios.forEach(radio => {
            if (radio.checked) selectedValue = radio.value;
        });

        // 1. まずは両方のタブボタンを表示状態に戻す
        labelRouteCondition.style.display = 'block';
        labelDisallowReason.style.display = 'block';

        // --- 2. フォーム活性・非活性の制御関数 ---
        const setFormDisabled = (container, isDisabled) => {
            const inputs = container.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                // タブ切り替え用のラジオボタン自体は disabled にしないよう注意
                if (input.name !== 'tab-1') {
                    input.disabled = isDisabled;
                }
            });
        };

        // 3. 選択された回答タイプに応じて、不要な「タブボタン」だけを消す
        if (selectedValue === "1" || selectedValue === "4") {
            // 許可回答 or 窓口：不許可タブボタンを隠す
            labelDisallowReason.style.display = 'none';
            setFormDisabled(contentDisallowReason, true);  // 不許可タブのデータを送らない
            setFormDisabled(contentRouteCondition, false); // 経路タブのデータを送る

            // もし隠したタブが選択されていたら、基本情報(一番左)に強制移動
            if (labelDisallowReason.querySelector('input').checked) {
                document.querySelector('input[name="tab-1"]').checked = true;
            }
        }
        else if (selectedValue === "3") {
            // 不許可回答：経路タブボタンを隠す
            labelRouteCondition.style.display = 'none';
            setFormDisabled(contentRouteCondition, true);  // 経路タブのデータを送らない
            setFormDisabled(contentDisallowReason, false); // 不許可タブのデータを送る

            // もし隠したタブが選択されていたら、基本情報に強制移動
            if (labelRouteCondition.querySelector('input').checked) {
                document.querySelector('input[name="tab-1"]').checked = true;
            }
        }
        // 「2:許可兼不許可」の場合は何もしない（両方表示される）
        else {
            setFormDisabled(contentRouteCondition, false);
            setFormDisabled(contentDisallowReason, false);
        }
    }

    typeRadios.forEach(radio => {
        radio.addEventListener('change', toggleTabs);
    });

    toggleTabs();
});

document.addEventListener('DOMContentLoaded', function () {
    // 💡 1. 必要な要素（ラジオボタンとセレクトボックス）を取得
    const radioButtons = document.querySelectorAll('input[name="answersheet_type"]');
    const clientSelect = document.querySelector('select[name="client_id"]');

    // 💡 2. 連動させる処理を関数化
    function toggleClientSelect() {
        // 現在チェックされているラジオボタンを取得
        const checkedRadio = document.querySelector('input[name="answersheet_type"]:checked');

        // 4番（窓口申請回答）が選ばれていたら、送り先を「0」にする
        if (checkedRadio && checkedRadio.value === '4') {
            clientSelect.value = '0';
        }
    }

    // 💡 3. ラジオボタンがクリックされた（変更された）ときに動かす
    radioButtons.forEach(radio => {
        radio.addEventListener('change', toggleClientSelect);
    });

    // 💡 4. 画面が開いた瞬間にも一度実行（エラー戻り時などの対策）
    toggleClientSelect();


});

