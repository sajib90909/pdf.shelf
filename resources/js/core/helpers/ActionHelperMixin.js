export default {
    methods: {
        actionTrigger(action, row, tableId){
            let functionName = `${action.key}Action`
            typeof this[functionName] === 'function' && this[functionName](row)
        }
    }
}
