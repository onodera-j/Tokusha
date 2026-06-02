document.addEventListener('DOMContentLoaded', () => {
    // すべてのルートコンテナ（複数のタブ分）を取得
    const containers = document.querySelectorAll('.route-rows');

    containers.forEach(container => {
        // 各コンテナ（タブ）ごとにイベントを設定
        container.addEventListener('change', async (e) => {
            const row = e.target.closest('.route-row');
            if (!row) return;

            const categorySelect = row.querySelector('.route-category');
            const routeSelect = row.querySelector('.route-select');
            const remarksBox = row.querySelector('.route-remarks');
            const fetchUrlTemplate = categorySelect.dataset.fetchUrl;

            row.routeData = row.routeData || [];

            /* -------- カテゴリ変更 -------- */
            if (e.target.classList.contains('route-category')) {
                const categoryId = categorySelect.value;

                // 初期化処理
                routeSelect.innerHTML = '<option value="">路線を選択してください</option>';
                routeSelect.disabled = true;
                routeSelect.classList.add('hidden');
                remarksBox.textContent = '';
                remarksBox.classList.add('hidden');
                row.routeData = [];

                if (!categoryId) return;

                try {
                    const url = fetchUrlTemplate.replace(':id', categoryId);
                    const res = await fetch(url);
                    row.routeData = await res.json();

                    if (row.routeData.length === 0) {
                        routeSelect.innerHTML = '<option value="">該当する路線がありません</option>';
                    } else {
                        row.routeData.forEach(route => {
                            routeSelect.insertAdjacentHTML('beforeend', `
                                <option value="${route.id}">${route.name}</option>
                            `);
                        });
                    }
                    routeSelect.disabled = false;
                    routeSelect.classList.remove('hidden');
                } catch (err) {
                    console.error("Fetch error:", err);
                }
            }

            /* -------- 路線選択 -------- */
            if (e.target.classList.contains('route-select')) {
                const routeId = routeSelect.value;
                remarksBox.textContent = '';
                remarksBox.classList.add('hidden');

                if (!routeId) return;

                const route = row.routeData.find(r => r.id == routeId);
                if (route?.remarks) {
                    remarksBox.textContent = route.remarks;
                    remarksBox.classList.remove('hidden');
                }

                // 最後の行なら、そのコンテナに新しい行を追加
                if (row === container.lastElementChild) {
                    addNewRow(container);
                }
            }
        });

    });

    const restoreRoutes = async () => {
        // ページ内に存在するすべてのカテゴリセレクトを確認
        const categorySelects = document.querySelectorAll('.route-category');

        for (const categorySelect of categorySelects) {
            const categoryId = categorySelect.value;

            // 値が入っている（oldで復元されている）場合のみ実行
            if (categoryId) {
                // 親の行要素を取得
                const row = categorySelect.closest('.route-row');
                const routeSelect = row.querySelector('.route-select');

                // HTML側に仕込んである old('route_id') の値を取得
                const oldRouteId = routeSelect.dataset.oldValue;
                const fetchUrlTemplate = categorySelect.dataset.fetchUrl;

                try {
                    const url = fetchUrlTemplate.replace(':id', categoryId);
                    const res = await fetch(url);
                    const routeData = await res.json();
                    row.routeData = routeData; // データを保存

                    // 路線セレクトボックスを構築
                    routeSelect.innerHTML = '<option value="">路線を選択してください</option>';
                    routeData.forEach(route => {
                        const selected = route.id == oldRouteId ? 'selected' : '';
                        routeSelect.insertAdjacentHTML('beforeend', `
                            <option value="${route.id}" ${selected}>${route.name}</option>
                        `);
                    });

                    // 表示状態にする
                    routeSelect.disabled = false;
                    routeSelect.classList.remove('hidden');

                    // 備考欄も復元
                    const selectedRoute = routeData.find(r => r.id == oldRouteId);
                    if (selectedRoute?.remarks) {
                        const remarksBox = row.querySelector('.route-remarks');
                        remarksBox.textContent = selectedRoute.remarks;
                        remarksBox.classList.remove('hidden');
                    }
                } catch (err) {
                    console.error("Restore error:", err);
                }
            }
        }
    };

    // 復元処理を実行
    restoreRoutes();


    // どのコンテナに追加するかを引数で受け取るように変更
    function addNewRow(container) {
        const lastRow = container.lastElementChild;
        if (!lastRow) return;

        const template = lastRow.cloneNode(true);
        const newIndex = container.children.length;

        // 行番号の更新
        template.dataset.index = newIndex;
        const numberEl = template.querySelector('.route-number');
        if (numberEl) numberEl.textContent = newIndex + 1;

        const categorySelect = template.querySelector('.route-category');
        const routeSelect = template.querySelector('.route-select');
        const remarksBox = template.querySelector('.route-remarks');

        //カテゴリセレクトの初期化
        categorySelect.value = '';
        categorySelect.disabled = false; // 確実に有効化
        categorySelect.removeAttribute('disabled'); // 属性も完全に削除

        // 路線セレクトの初期化
        routeSelect.innerHTML = '<option value="">路線を選択してください</option>';
        routeSelect.disabled = true;
        routeSelect.classList.add('hidden');
        routeSelect.removeAttribute('data-old-value'); // 以前のoldの記憶を消す

        // 備考欄の初期化
        remarksBox.textContent = '';
        remarksBox.classList.add('hidden');
        template.routeData = [];

        container.appendChild(template);
    }
});
