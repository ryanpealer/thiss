acf.add_filter('color_picker_args', function( args, $field ){

    // do something to args
    args.palettes = ['#002F86', '#001947', '#147FBE', '#0E5680', '#FFAE00', '#E69D00', '#000000', '#ffffff']


    // return
    return args;

});