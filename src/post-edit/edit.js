/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';
import classnames from 'classnames';
/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/packages/packages-block-editor/#useBlockProps
 */
import { AlignmentControl,
	BlockControls,
	InspectorControls,
	useBlockProps } from '@wordpress/block-editor';

import { PanelBody, PanelRow,TextControl } from '@wordpress/components';
/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit ( { attributes, className, isSelected, setAttributes } ) {
	const onChangeLabel = ( event ) => {
		setAttributes( { label: event } );
	};
	const { textAlign, label } = attributes;

	const blockProps = useBlockProps( {
		className: classnames( {
			[ `has-text-align-${ textAlign }` ]: textAlign,
		} ),
	} );


	return (
		<>
			<BlockControls group="block">
				<AlignmentControl
					value={ textAlign }
					onChange={ ( nextAlign ) => {
						setAttributes( { textAlign: nextAlign } );
					} }
				/>
			</BlockControls>
			<InspectorControls>
				<PanelBody>
				<PanelRow>
				<TextControl
				label={ __("Link text", 'sb-post-edit-block' ) }
				value={ label }
				onChange={ onChangeLabel }
			/>
				</PanelRow>
				</PanelBody>

			</InspectorControls>



			<div { ...blockProps }><a href="#">{ label }</a>

	</div>
			</>


	);
}
