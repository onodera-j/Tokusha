document.addEventListener('DOMContentLoaded', () => {
    // 同期させたいクラスのリスト
    const syncClasses = ['.js-sync-width-B', '.js-sync-width-C'];

    syncClasses.forEach(className => {
        const checkboxes = document.querySelectorAll(className);

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', (e) => {
                const isChecked = e.target.checked;
                // 同じクラスを持つすべてのチェックボックスの状態を更新
                document.querySelectorAll(className).forEach(el => {
                    el.checked = isChecked;
                });
            });
        });
    });
});
