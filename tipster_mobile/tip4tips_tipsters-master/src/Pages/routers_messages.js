import React from 'react';

import MessagesPage from './Messages/Messages.Page';
import MailDetailPage from './Messages/MailDetail.Page';

const routersMessages = [
	{
		path: '/messages',
		exact: true,
		main: () => <MessagesPage />
	},
	{
		path: '/messages/show/:id',
		exact: true,
		main: ({history,match}) => <MailDetailPage history = {history} match = {match}/>
	}
];

export default routersMessages;