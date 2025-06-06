import React from 'react'
import { __ } from '@wordpress/i18n'
import { TagEditor } from '../../common/TagEditor'
import { ExplainSnippetButton } from '../buttons/ExplainSnippetButton'
import { useSnippetForm } from '../SnippetForm/context'

const options = window.CODE_SNIPPETS_EDIT?.tagOptions

export const TagsInput: React.FC = () => {
	const { snippet, setSnippet, isReadOnly } = useSnippetForm()

	return options?.enabled ?
		<div className="snippet-tags-container">
			{'' === snippet.code.trim() ? null :
				<ExplainSnippetButton
					field="tags"
					snippet={snippet}
					disabled={isReadOnly}
					onResponse={generated => {
						setSnippet(previous => ({
							...previous,
							tags: [...new Set([...previous.tags, ...generated.tags ?? []])]
						}))
					}}
				>
					{__('Add Tags', 'code-snippets')}
				</ExplainSnippetButton>}

			<h2>
				<label htmlFor="snippet_tags">
					{__('Tags', 'code-snippets')}
				</label>
			</h2>

			<TagEditor
				id="snippet_tags"
				tags={snippet.tags}
				addOnBlur
				disabled={isReadOnly}
				onChange={tags => setSnippet(previous => ({ ...previous, tags }))}
				completions={options.availableTags}
				allowSpaces={options.allowSpaces}
				placeholder={__('Enter a list of tags; separated by commas.', 'code-snippets')}
			/>
		</div> :
		null
}
