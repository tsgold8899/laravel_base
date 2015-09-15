{{
	Navbar::inverse()
		->with_brand('RRRR Training Admin', '#')
		->with_menus(
			Navigation::links(
				array(
					array('Home', URL::to('admin')),
					array('Courses', '#', false, false,
						array(
							array('Courses', '#'),
							array('Categories', URL::to('categories')),
							array('Course events', '#'),
							array('Course recurrences', '#'),
						)
					),
					array('Regions', URL::to('regions')),
					array('Venues', URL::to('venues')),
					array('Email templates', URL::to('emails')),
					array('Questions', '#', false, false,
						array(
							array('Question groups', '#'),
							array('Enrolment questions', '#'),
						)
					)
				)
			)
	); 
}}