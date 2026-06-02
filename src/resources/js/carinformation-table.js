document.addEventListener('DOMContentLoaded', () => {
    const tableBody = document.querySelector('.table-car tbody');
    const bothMinInput = document.querySelector('.js-both-min'); // 双方幅員
    const oneMinInput = document.querySelector('.js-one-min');   // 一方幅員

    // 判定ロジック関数
    function getJudge(result) {
        if (result >= -50) return "A";
        if (result >= -100) return "B";
        return "C";
    }

    // 計算メイン処理
    function calculateAll() {
        const bothMin = parseFloat(bothMinInput.value) || 0;
        const oneMin = parseFloat(oneMinInput.value) || 0;

        const rows = tableBody.querySelectorAll('tr');
        rows.forEach(row => {
            const carWidth = parseFloat(row.querySelector('input[name="car_width[]"]').value) || 0;

            // 双方通行の計算（セル索引 6:結果, 7:評価）
            if (bothMin > 0 && carWidth > 0) {
                const resBoth = ((bothMin - 150) / 2) - carWidth;
                const judgeBoth = getJudge(resBoth);
                row.cells[7].textContent = Math.round(resBoth);
                row.cells[8].textContent = judgeBoth;
                row.cells[8].className = 'judge-' + judgeBoth; // CSSで色分け用
            }

            // 一方通行の計算（セル索引 8:結果, 9:評価）
            if (oneMin > 0 && carWidth > 0) {
                const resOne = (oneMin - 150) - carWidth;
                const judgeOne = getJudge(resOne);
                row.cells[9].textContent = Math.round(resOne);
                row.cells[10].textContent = judgeOne;
                row.cells[10].className = 'judge-' + judgeOne;
            }
        });
    }

    // イベントリスナー（入力があったら計算）
    [bothMinInput, oneMinInput].forEach(el => el.addEventListener('input', calculateAll));

    tableBody.addEventListener('input', (e) => {
        // 車両幅が入力されたら再計算
        if (e.target.name === "car_width[]") calculateAll();

        // --- 行の自動追加処理 ---
        const currentRow = e.target.closest('tr');
        if (currentRow === tableBody.lastElementChild && e.target.value.trim() !== '') {
            const newRow = currentRow.cloneNode(true);
            newRow.querySelectorAll('input').forEach(input => input.value = '');
            // 計算セルを初期化
            [7, 8, 9, 10].forEach(i => newRow.cells[i].textContent = (i % 2 === 0 ? '-' : '-'));
            tableBody.appendChild(newRow);

            // No.の更新
            tableBody.querySelectorAll('tr').forEach((r, i) => r.cells[0].textContent = i + 1);
        }
    });
});
